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
        foreach ($plans as  $item) {
            $item->description = explode(",", $item->description);
        }
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
    public function update(Request $request, Plan $plan)
    {

        $plan->podcasts = $request->podcasts;
        $plan->gallary = $request->gallery;
        $plan->ebooks = $request->ebooks;


        $description = [];
        $description[] = $request->podcasts ? "Access $request->podcasts podcasts" : 'All podcasts unlimited access.';
        $description[] = $request->gallery ? "Access $request->gallery ccomplishment Gallery" : 'All ccomplishment Gallery unlimited access.';
        $description[] = $request->ebooks ? "Access $request->ebooks ebooks" : 'All ebooks unlimited access.';
        // $description[] = $request->details;
        $plan->description = implode(",", $description);
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
                $charge = \Stripe\Charge::create(
                    array(
                        "amount" => $plan->price * 100,
                        "currency" => $plan->currency,
                        "customer" => $customer->id
                    )
                );
            } else {
                return response()->json(['error' => 'Stripe customer could not be created'], 400);
            }

            // updating stripe customer and subscripion id
            $user->subscription_id = $subscription->id;
            $user->customer_id = $customer->id;
            $user->save();

            // checking if already a plan exists
            $msg = 'upgraded';
            if ($subscription && $charge) {

                $user_plan_exists = UserPlanDetail::where("user_id", $user_id)->where("status", "Active")->count();
                if ($user_plan_exists) {
                    $user_plan_exists = UserPlanDetail::where("user_id", $user_id)->where("status", "Active")->first();
                    $user_plan_exists->status = "Inactive";
                    $user_plan_exists->save();
                    if ($user_plan_exists->plan->price > $plan->price) {
                        $msg = "downgraded";
                    }
                    try {
                        $this->cancelPlan($user_plan_exists->subs_id);
                    } catch (\Throwable $th) {
                    }
                }

                $user_plan = new UserPlanDetail();
                $user_plan->user_id = $user_id;
                $user_plan->subs_id = $subscription->id;
                $user_plan->transaction_id = $charge->id;
                $user_plan->plan_id = $plan_id;
                $user_plan->status = "Active";
                $user_plan->start_date = Carbon::now();
                $user_plan->end_date = Carbon::now()->addDay(28);
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
}
