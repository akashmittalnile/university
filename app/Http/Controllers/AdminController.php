<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPlanDetail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $total_users = User::where("admin", "!=", 1)->count();
        $subscribe_users = UserPlanDetail::distinct('user_id')->count();

        $total_earning = UserPlanDetail::join('plans', 'user_plan_details.plan_id', '=', 'plans.id')
            ->select(DB::raw('SUM(plans.price) as total_price'))
            ->first();
        $total_earning = $total_earning ? $total_earning->total_price : 0;

        $transactions = UserPlanDetail::join('plans', 'user_plan_details.plan_id', '=', 'plans.id')->join('users', 'user_plan_details.user_id', '=', 'users.id');
        if($request->filled('search')) $transactions->where("users.name", "LIKE", "%$request->search%")->orWhere('plans.price', $request->search);
        if($request->filled('receive_date')) $transactions->whereDate('user_plan_details.created_at', date('Y-m-d', strtotime($request->receive_date)));
        $transactions = $transactions->select('user_plan_details.*', 'user_plan_details.created_at as receive_date')->orderBy("user_plan_details.id", "desc")->limit(5)->get();
        return view("admin.dashboard", compact('total_users', 'total_earning', 'transactions', 'subscribe_users'));
    }

    public function dashboardDownloadReport(Request $request)
    {
        $transactions = UserPlanDetail::join('plans', 'user_plan_details.plan_id', '=', 'plans.id')->join('users', 'user_plan_details.user_id', '=', 'users.id')->when(request()->has('search'), function ($query) {
            $name = request('search');
            return $query->where("users.name", "LIKE", "%$name%")->orWhere('plans.price', $name);
        })->orderBy("user_plan_details.id", "desc")->get();
        return $this->downloadDownloadReportFile($transactions);
    }

    public function downloadDownloadReportFile($data)
    {

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
    }

    public function signin(Request $request)
    {
        if (auth()->user() && (auth()->user()->role_id == 1)) {
            return redirect(route("admin.dashboard"));
        }
        return view("admin.signin");
    }
    public function profile(Request $request)
    {
        $admin = User::find(auth()->user()->id);
        $title = 'Admin Profile';
        return view("admin.profile", compact('admin', 'title'));
    }

    public function profile_update(Request $request)
    {
        if ($request->has('current_password')) {
            request()->validate([
                'password' => 'required',
            ]);
            if (Auth::attempt(['email' => auth()->user()->email, 'password' => $request->current_password])) {
                $user = User::where('id', auth()->user()->id)->first();
                $user->password = Hash::make($request->password);
                $user->save();
                return successMsg("Password changed Successfully.");
            } else {
                return errorMsg('Please enter correct current password.');
            }
        }
        $user = User::where('id', auth()->user()->id)->first();
        if ($request->hasFile("file")) {
            if(isset($user->profile)){
                $link = public_path() . "/uploads/profile/" . $user->profile;
                if (file_exists($link)) {
                    unlink($link);
                }
            }
            $name = fileUpload($request->file, "uploads/profile");
            $user->profile = $name;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();
        return successMsg('Profile updated Successfully.');
    }

    public function signin_post(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        try {
            $user = User::where('email', $request->email)->first();
            if(isset($user->id)){
                if($user->status == 0) return response()->json(['message' => 'Your account is currently pending for approval.', 'status' => 201]);
                if($user->status == 2) return response()->json(['message' => 'Your account is inactive.', 'status' => 201]);
                if($user->status == 3) return response()->json(['message' => 'Your account is rejected by the admin.', 'status' => 201]);
                if (Auth::attempt($request->only(['email', 'password']))) {
                    $user = User::where("email", $request->email)->first();
                    if ($user->admin == 1) {
                        Auth::login($user);
                        return response()->json(['message' => 'Logged In Successfully. ', 'redirect' => true, 'route' => route("admin.dashboard"), 'status' => 200]);
                    } else {
                        Auth::login($user);
                        session()->forget('error');
                        return response()->json(['message' => 'Logged In Successfully. ', 'redirect' => true, 'route' => route("user.profile"), 'status' => 200]);
                    }
                } else {
                    return response()->json(['message' => 'Invalid Password. ', 'status' => 201]);
                }
            } else {
                return response()->json(['message' => 'This email is not registered with us', 'status' => 201]);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => 201]);
        }
    }

    public function checkPassword(Request $request)
    {
        try{
            $user = User::where('id', auth()->user()->id)->first();
            if(!(Hash::check($request->current_password, $user->password))){
                echo json_encode("Old Password doesn't match with Current Password.");
            } else echo json_encode(true);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route("home"));
    }
}
