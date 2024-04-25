<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\UserPlanDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Customer;
use Stripe\Stripe;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::orderBy("price", "asc")->get();
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $plan = Plan::where('id', $id)->first();

        $plan->description = $request->description;
        $plan->updated_at = date('Y-m-d H:i:s');
        $plan->save();
        return redirect()->back()->with("success", "Plan updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
    public function getPlans(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $plans = $stripe->products->all(['limit' => 3]);
        // dd($plans);
        foreach ($plans as $item) {
            $product_id = $item["id"];
            $price = $stripe->prices->retrieve(
                $item->default_price,
                []
            );;
            $plan = Plan::where("product_id", $product_id)->first();
            // dd($plan, $item);
            if ($plan) {
                $plan->price = $price->unit_amount / 100;
                $plan->currency = $price->currency;

                $plan->name = $item->name;
                $plan->type = $price->recurring->interval;
                $plan->price_id = $item["default_price"];
                $plan->save();
            } else {
                $plan = new Plan();
                $plan->price = $price->unit_amount / 100;
                $plan->name = $item->name;
                $plan->currency = $price->currency;
                $plan->product_id = $product_id;
                $plan->price_id = $item["default_price"];
                $plan->type = $price->recurring->interval;
                $plan->save();
            }
        }
        return redirect()->back()->with('success', 'Plan Fetched Successfully');
    }

    function purchase(Request $request)
    {
        $request->validate(
            [
                'user_id' => 'required',
                'plan_id' => 'required',
            ]
        );
        try {
            // dd($request->all());
            Stripe::setApiKey(env("STRIPE_SECRET"));

            // dd($request->all());
            $user_id = $request->input('user_id');
            $plan_id = $request->input('plan_id');
            $plan = Plan::find($plan_id);
            $user = User::find($user_id);

            $customer = null;
            // Create a new Stripe Customer
            if ($user->customer_id) {
                $customer =  Customer::retrieve(
                    $user->customer_id,
                    []
                );
            } else {

                $customer = Customer::create([
                    'email' => $user->email,
                    'name' => $user->name, // Optional: Customer's name
                    "source" => $request->stripeToken
                ]);
            }

            // creating user subscription
            if ($customer && $plan->price_id) {
                $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
                $subscription =  $stripe->subscriptions->create([
                    'customer' => $customer->id,
                    'items' => [
                        ['price' => $plan->price_id],
                    ],
                ]);

                // charing user for subscription
                // $charge = \Stripe\Charge::create(
                //     array(
                //         "amount" => $plan->price * 100,
                //         "currency" => $plan->currency,
                //         "customer" => $customer->id
                //     )
                // );
            } else {
                return response()->json(['error' => 'Stripe customer could not be created'], 400);
            }

            // updating stripe customer and subscripion id
            $user->subscription_id = $subscription->id;
            $user->customer_id = $customer->id;
            $user->save();

            // checking if already a plan exists
            $msg = 'upgraded';
            if ($subscription) {

                $user_plan_exists = UserPlanDetail::where("user_id", $user_id)->where("status", "Active")->count();
                if ($user_plan_exists) {
                    $user_plan_exists = UserPlanDetail::where("user_id", $user_id)->where("status", "Active")->first();
                    $user_plan_exists->status = "Inactive";
                    $user_plan_exists->save();
                    $stripe->subscriptions->cancel($user_plan_exists->subs_id, []);
                    if ($user_plan_exists->plan->price > $plan->price) {
                        $msg = "downgraded";
                    }
                }

                $user_plan = new UserPlanDetail();
                $user_plan->user_id = $user_id;
                $user_plan->subs_id = $subscription->id;
                $user_plan->plan_id = $plan_id;
                $user_plan->status = "Active";
                $user_plan->start_date = Carbon::now();
                $user_plan->end_date = Carbon::now()->addDay(30);
                $user_plan->save();
            }
            session()->forget("email");
            Auth::login($user);
            return redirect()->back()->with("success", 'Your subscription is ' . $msg);
        } catch (\Exception $e) {
            // Handle errors
            return response()->json(['error' => $e->getMessage()], 201);
        }
    }

    public function cancelSubscription($id){
        try{
            $id = encrypt_decrypt('decrypt', $id);
            $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
            $plan = UserPlanDetail::where('id', $id)->where('status', 'Active')->first();
            $stripe->subscriptions->cancel($plan->subs_id, []);
            return redirect()->back()->with('success', 'Subscription Plan Cancelled Successfully.');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function cancelPlan($subs_id)
    {
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $subs =     $stripe->subscriptions->retrieve(
            $subs_id,
            []
        );
        if ($subs) {
            $subs_cacel = $stripe->subscriptions->cancel(
                $subs_id,
                []
            );
        }
    }

    public function transactionLogs(Request $request){
        try{
            $count = UserPlanDetail::count();
            $transactions = UserPlanDetail::join('plans', 'user_plan_details.plan_id', '=', 'plans.id')->join('users', 'user_plan_details.user_id', '=', 'users.id');
            if($request->filled('search')) $transactions->where("users.name", "LIKE", "%$request->search%")->orWhere('plans.price', $request->search);
            if($request->filled('from_date')) $transactions->whereDate('user_plan_details.created_at', '>=', date('Y-m-d', strtotime($request->from_date)));
            if($request->filled('to_date')) $transactions->whereDate('user_plan_details.created_at', '<=', date('Y-m-d', strtotime($request->to_date)));
            $transactions = $transactions->select('user_plan_details.*', 'user_plan_details.created_at as receive_date', 'user_plan_details.updated_at as renew_date')->orderBy("user_plan_details.id", "desc")->paginate(config("app.records_per_page"));
            return view('admin.plans.transaction-logs')->with(compact('transactions', 'count'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function downloadTransactionList(Request $request)
    {
        try{
            $transactions = UserPlanDetail::join('plans', 'user_plan_details.plan_id', '=', 'plans.id')->join('users', 'user_plan_details.user_id', '=', 'users.id');
            if($request->filled('search')) $transactions->where("users.name", "LIKE", "%$request->search%")->orWhere('plans.price', $request->search);
            if($request->filled('receive_date')) $transactions->whereDate('user_plan_details.created_at', date('Y-m-d', strtotime($request->receive_date)));
            $transactions = $transactions->select('user_plan_details.*', 'user_plan_details.created_at as receive_date', 'user_plan_details.updated_at as renew_date')->orderBy("user_plan_details.id", "desc")->get();
            return $this->downloadtransactionsReportFile($transactions);
        } catch (\Exception $e) {
            return errorMsg($e->getMessage());
        }
    }

    public function downloadtransactionsReportFile($data)
    {
        try{
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="Transaction logs "' . time() . '.csv');
            $output = fopen("php://output", "w");

            fputcsv($output, array('S.no', 'Name', 'Subscription Plan', 'Amount Paid', 'Billing type', 'Billing Due Date', 'Amount Received On', 'Purchased on'));

            if (count($data) > 0) {
                foreach ($data as $key => $row) {
                    if ($row->user && $row->plan){
                        $final = [
                            $key + 1,
                            $row->user->name,
                            $row->plan->name,
                            '$'.number_format(intval($row->plan->price), 2, '.', ','),
                            ucfirst($row->plan->type),
                            date('d M Y', strtotime('+1 month'.$row->renew_date)),
                            date('d M Y', strtotime($row->renew_date)),
                            date('d M Y, h:i:s a', strtotime($row->receive_date)),
                        ];
                    }
                    fputcsv($output, $final);
                }
            }
        }catch (\Exception $e) {
            return errorMsg($e->getMessage());
        }
    }
}
