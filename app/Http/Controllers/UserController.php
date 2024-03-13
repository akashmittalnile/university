<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPlanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $count = User::where("admin", 0)->count();
        $users = User::where("admin", 0);
        if ($request->filled('search')) {
            $search = trim(request('search'));
            $users->where("name", "LIKE", "%$search%")->orWhere("email", "LIKE", "%$search%")->orWhere("phone", "LIKE", "%$search%");
        }
        if($request->filled('status')){
            $users->where('status', $request->status);
        }
        $users = $users->orderByDesc('id')->paginate(config("app.records_per_page"));
        return view('admin.users.index', compact('users', 'count'));
    }

    public function viewDetails($id, Request $request)
    {
        $id = encrypt_decrypt('decrypt', $id);
        $currentPlan = UserPlanDetail::where("user_id", $id)->orderByDesc('id')->first();
        $currentPlan = $currentPlan ? $currentPlan->plan : null;
        $plans = UserPlanDetail::where("user_id", $id)->get();
        $total = 0;
        foreach ($plans as $item) {
            $total += $item->plan->price ?? 0;
        }
        $user = User::where("id", $id)->first();

        $transactions = UserPlanDetail::join('plans', 'user_plan_details.plan_id', '=', 'plans.id')->join('users', 'user_plan_details.user_id', '=', 'users.id')->where("user_plan_details.user_id", $id);
        if($request->filled('search')) $transactions->where("users.name", "LIKE", "%$request->search%")->orWhere('plans.price', $request->search);
        if($request->filled('receive_date')) $transactions->whereDate('user_plan_details.created_at', date('Y-m-d', strtotime($request->receive_date)));
        $transactions = $transactions->select('user_plan_details.*', 'user_plan_details.created_at as receive_date')->orderBy("user_plan_details.id", "desc")->get();

        return view('admin.users.user-details', compact('user', 'currentPlan', 'total', 'transactions'));
    }

    public function userDetailDownloadReport(Request $request, $id)
    {
        try{
            $id = encrypt_decrypt('decrypt', $id);
            $transactions = UserPlanDetail::join('plans', 'user_plan_details.plan_id', '=', 'plans.id')->join('users', 'user_plan_details.user_id', '=', 'users.id')->where("user_plan_details.user_id", $id);
            if($request->filled('search')) $transactions->where("users.name", "LIKE", "%$request->search%")->orWhere('plans.price', $request->search);
            if($request->filled('receive_date')) $transactions->whereDate('user_plan_details.created_at', date('Y-m-d', strtotime($request->receive_date)));
            $transactions = $transactions->select('user_plan_details.*', 'user_plan_details.created_at as receive_date')->orderBy("user_plan_details.id", "desc")->get();
            return $this->userDetailDownloadReportFile($transactions);
        } catch (\Exception $e) {
            return errorMsg($e->getMessage());
        }
    }

    public function userDetailDownloadReportFile($data) 
    {
        try{
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="Membership transaction "' . time() . '.csv');
            $output = fopen("php://output", "w");

            fputcsv($output, array('S.no', 'Name', 'Subscription Plan', 'Amount Paid', 'Billing type', 'Billing Due Date', 'Amount Received On'));

            if (count($data) > 0) {
                foreach ($data as $key => $row) {
                    if ($row->user && $row->plan){
                        $final = [
                            $key + 1,
                            $row->user->name,
                            $row->plan->name,
                            '$'.number_format(intval($row->plan->price), 2, '.', ','),
                            ucfirst($row->plan->type),
                            '1st of Every Month',
                            date('d M Y, h:i:s a', strtotime($row->created_at)),
                        ];
                    }
                    fputcsv($output, $final);
                }
            }
        } catch (\Exception $e) {
            return errorMsg($e->getMessage());
        }
    }

    public function userChangeStatus(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'status' => 'required',
            ]);
            if ($validator->fails()) {
                return errorMsg($validator->errors()->first());
            } else {
                $id = encrypt_decrypt('decrypt', $request->id);
                $user = User::where('id', $id)->update([
                    'status'=> $request->status
                ]);
                return successMsg('Status changed successfully');
            }
        } catch (\Exception $e) {
            return errorMsg($e->getMessage());
        }
    }

    public function approveReject($id, $status)
    {
        try {
            $id = encrypt_decrypt('decrypt', $id);
            $status = encrypt_decrypt('decrypt', $status);
            User::where('id', $id)->update([
                'status'=> $status
            ]);
            $user = User::where('id', $id)->first();
            $msg = ($status == 1) ? 'approved' : 'rejected';
            $mailMsg = ($status == 1) ? "Congratulations, $user->name. Your account was approved by administrator" : "Your account is rejected. Maybe some information is incomplete or the Administrator wants you to improve.";
            $mailSubject = ($status == 1) ? "University PMO Account Approved" : "University PMO Account Rejected";
            $data['name'] = $user->name;
            $data['to_mail'] = $user->email;
            $data['subject'] = $mailSubject;
            $data['body'] = $mailMsg;
            sendMail($data);
            return redirect()->back()->with('success', 'User ' .$msg. ' successfully');
        } catch (\Exception $e) {
            return errorMsg($e->getMessage());
        }
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:2',
                'email' => 'required|unique:users|email',
                'phone' => 'required|min:10',
                'password' => 'required|confirmed|min:6',
                'file' => 'required|file'
            ]
        );

        try {
            $user = new User();

            if ($request->hasFile("file")) {
                $name = fileUpload($request->file, "uploads/profile");
                $user->profile = $name;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->status = 0;
            $user->password = Hash::make($request->password);
            $user->save();

            $data['name'] = $user->name;
            $data['to_mail'] = $user->email;
            $data['subject'] = 'Welcome to University PMO Family';
            $data['body'] = "Congratulations, $user->name! We are so glad you joined. Please wait until your account was approved by administrator.";
            sendMail($data);

            return response()->json(['status' => 200, 'message' => 'User registered successfully']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 201, 'message' => $th->getMessage()]);
        }
    }
    public function logout()
    {
        if (auth()->user()) {
            Auth::logout(auth()->user());
        }
        return redirect(route("home"));
    }
}
