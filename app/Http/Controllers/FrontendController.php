<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Blog;
use App\Models\BusinessLink;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Ebook;
use App\Models\GalleryAttribute;
use App\Models\Plan;
use App\Models\Podcast;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\UserPlanDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{

    public function profile()
    {
        try{
            $user = auth()->user();
            $currentPlan = UserPlanDetail::where("user_id", auth()->user()->id)->where("status", "Active")->first();
            $currentPlan = $currentPlan ? $currentPlan->plan : null;
            $plans = UserPlanDetail::where("user_id", auth()->user()->id)->get();
            $total = 0;
            foreach ($plans as $item) {
                $total += $item->plan->price ?? 0;
            }
            return view("frontend.profile", compact('user', 'currentPlan', 'total'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
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
        if($request->email != $user->email){
            $isEmailExist = User::where('email', $request->email)->first();
            if(isset($isEmailExist->id)){
                return response()->json(['message' => 'This email is already registered', 'status' => false]);
            }
        }

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

    public function forgotPassword()
    {
        try{
            return view('frontend.auth.forgot-pass');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function forgotPasswordSendOTP(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required'
            ]);
            if ($validator->fails()) {
                return errorMsg($validator->errors()->first());
            } else {
                $code = rand(1000, 9999);
                $user = User::where('email', $request->email)->first();
                if(isset($user->id)){
                    if($user->status != 1) return errorMsg('Your account was temporarily inactive by administrator!');
                    User::where('email', $request->email)->update([
                        'remember_token' => $code
                    ]);
                    $data['site_title'] = 'Forgot Password - Email Verification OTP';
                    $data['subject'] = 'Forgot Password - Email Verification OTP';
                    $data['view'] = 'layouts.email.send-otp';
                    $data['to_email'] = $request->email;
                    $data['customer_name'] = $request->name;
                    $data['otp'] = $code;
                    sendEmail($data);
                    $redirect_url = route('verify.otp', encrypt_decrypt('encrypt', $request->email));
                    return successMsg('OTP is sended to your email address', $redirect_url);
                } else return errorMsg('This email address is not registered with university PMO');
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function verifyOTP($email)
    {
        try{
            return view('frontend.auth.verify-otp')->with(compact('email'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function verifyingOTP(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'otp1' => 'required',
                'otp2' => 'required',
                'otp3' => 'required',
                'otp4' => 'required',
            ]);
            if ($validator->fails()) {
                return errorMsg($validator->errors()->first());
            } else {
                $email = encrypt_decrypt('decrypt', $request->email);
                $user = User::where('email', $email)->first();
                $otp = $request['otp1'].''.$request['otp2'].$request['otp3'].$request['otp4'];
                if(isset($user->id)){
                    $check_otp = User::where('email', $email)->where('remember_token', $otp)->first();
                    if (isset($check_otp->id)) {
                        $redirect_url = route('reset.password', encrypt_decrypt('encrypt', $email));
                        return successMsg('OTP verified successfully.', $redirect_url);
                    } else {
                        return errorMsg('Incorrect OTP');
                    }
                } else return errorMsg('This email address is not registered with university PMO');
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function resetPassword($email)
    {
        try {
            return view('frontend.auth.reset-pass')->with(compact('email'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required',
                'new_password' => 'required',
            ]);
            if ($validator->fails()) {
                return errorMsg($validator->errors()->first());
            } else {
                $email = encrypt_decrypt('decrypt', $request->email);
                $user = User::where('email', $email)->first();
                if(isset($user->id)){
                    User::where('email', $email)->update([
                        'password' => Hash::make($request->password),
                        'remember_token' => null
                    ]);
                    return successMsg('Password reset successfully.');
                } else return errorMsg('This email address is not registered with university PMO');
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function subscription()
    {
        try {
            $now = Carbon::now();
            $plans = Plan::orderBy("price", "asc")->get();
            $myPlans = UserPlanDetail::leftJoin('plans as p', 'p.id', '=', 'user_plan_details.plan_id')->where('user_id', auth()->user()->id)->where('end_date', '>=', $now)->select('user_plan_details.plan_id', 'user_plan_details.id', 'p.price')->orderByDesc('id')->first();
            foreach ($plans as  $item) {
                if(!isset($myPlans->id) && ($item->price == 0)){
                    $item->current_plan = true;
                    $item->current_plan_price = 0;
                } elseif (isset($myPlans->id) && ($item->id == $myPlans->plan_id)) {
                    $item->current_plan = true;
                    $item->current_plan_price = $myPlans->price ?? 0;
                } else {
                    $item->current_plan = false;
                    $item->current_plan_price = $myPlans->price ?? 0;
                } 
            }
            // dd($plans);
            return view("frontend.subscription", compact('plans'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function user()
    {
        return view("frontend.user");
    }

    public function index()
    {
        $home = Content::where('name', 'home')->first();
        $data = unserialize($home->value);
        $badges = Badge::where('status', 1)->get();
        $test = Testimonial::where('status', 1)->orderByDesc('id')->get();
        return view("index")->with(compact('home', 'badges', 'data', 'test'));
    }

    public function about()
    {
        $about = Content::where("name", 'about')->first();
        $data = unserialize($about->value);
        $how = Content::where("name", 'how_we_do_it')->first();
        $data2 = unserialize($how->value);
        return view("frontend.about", compact('about', 'how', 'data', 'data2'));
    }

    public function affiliate()
    {
        $product = Product::orderByDesc('id')->get();
        $affiliate = Content::where("name", 'affiliate')->first();
        $data = unserialize($affiliate->value);
        $link = BusinessLink::orderByDesc("id")->get();
        return view("frontend.affiliate")->with(compact('affiliate', 'data', 'product', 'link'));
    }

    public function blog()
    {
        try{
            $blog = Blog::orderByDesc('id')->get();
            return view("frontend.blog")->with(compact('blog'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function products()
    {
        try{
            $product = Product::orderByDesc('id')->get();
            return view("frontend.product")->with(compact('product'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function blogDetails($id)
    {
        try{
            $id = encrypt_decrypt('decrypt', $id);
            $blog = Blog::where('id', $id)->first();
            return view("frontend.blog-details")->with(compact('blog'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function accomplishment()
    {
        $gallery = GalleryAttribute::orderByDesc('id')->get();
        return view("frontend.accomplishment")->with(compact('gallery'));
    }

    public function markNetwork()
    {
        $now = Carbon::now();
        $plans = Plan::orderBy("price", "asc")->get();
        if(isset(auth()->user()->id)){
            $myPlans = UserPlanDetail::leftJoin('plans as p', 'p.id', '=', 'user_plan_details.plan_id')->where('user_id', auth()->user()->id)->where('end_date', '>=', $now)->select('user_plan_details.plan_id', 'user_plan_details.id', 'p.price')->orderByDesc('id')->first();
        }
        foreach ($plans as  $item) {
            if(!isset($myPlans->id) && ($item->price == 0)){
                if(isset(auth()->user()->id))
                    $item->current_plan = true;
                else $item->current_plan = false;
                $item->current_plan_price = 0;
            } elseif (isset($myPlans->id) && ($item->id == $myPlans->plan_id)) {
                $item->current_plan = true;
                $item->current_plan_price = $myPlans->price ?? 0;
            } else {
                $item->current_plan = false;
                $item->current_plan_price = $myPlans->price ?? 0;
            } 
        }
        $network = Content::where("name", 'mark-network')->first();
        $data = unserialize($network->value);
        return view("frontend.mark-network", compact("plans", "network", "data"));
    }

    public function markBurnet()
    {
        $product = Product::orderByDesc('id')->get();
        $burnet = Content::where("name", 'mark-burnet')->first();
        $data = unserialize($burnet->value);
        return view("frontend.mark-burnet")->with(compact('burnet', 'data', 'product'));
    }

    public function resources()
    {
        try{
            $now = Carbon::now();
            $blogs = Blog::orderByDesc('id')->limit(3)->get();
            $ebook = Ebook::orderByDesc('id')->limit(3)->get();
            $podcast = Podcast::orderByDesc('id')->limit(3)->get();
            if(isset(auth()->user()->id))
                $myPlans = UserPlanDetail::where('user_id', auth()->user()->id)->where('end_date', '>=', $now)->pluck('plan_id')->toArray();
            else $myPlans = array();
            $ebooks = [];
            $podcasts = [];
            foreach($ebook as $val){
                $arr = explode(',', $val->plans);
                $isPurchase = array_intersect($arr,$myPlans);
                $plan = Plan::where('id', $val->plans)->first();
                if(count($isPurchase) > 0)
                $temp['purchase'] = true;
                else $temp['purchase'] = false;
                $temp['plan_name'] = $plan->name;
                $temp['name'] = $val->name;
                $temp['description'] = $val->description;
                $temp['thumbnail'] = $val->thumbnail;
                $temp['pdf_file'] = $val->pdf_file;
                $ebooks[] = $temp;
            }
            foreach($podcast as $val){
                $arr = explode(',', $val->plans);
                $isPurchase = array_intersect($arr,$myPlans);
                $plan = Plan::where('id', $val->plans)->first();
                if(count($isPurchase) > 0)
                $temp['purchase'] = true;
                else $temp['purchase'] = false;
                $temp['plan_name'] = $plan->name;
                $temp['name'] = $val->name;
                $temp['description'] = $val->description;
                $temp['thumbnail'] = $val->thumbnail;
                $temp['id'] = $val->id;
                $temp['file_type'] = $val->file_type;
                $temp['audio_file'] = $val->audio_file;
                $podcasts[] = $temp;
            }
            $product = Product::orderByDesc('id')->get();
            return view("frontend.resources")->with(compact('podcasts', 'ebooks', 'blogs', 'product'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function podcast()
    {
        try{
            $now = Carbon::now();
            $podcast = Podcast::orderByDesc('id')->get();
            if(isset(auth()->user()->id))
                $myPlans = UserPlanDetail::where('user_id', auth()->user()->id)->where('end_date', '>=', $now)->pluck('plan_id')->toArray();
            else $myPlans = array();
            $podcasts = [];
            foreach($podcast as $val){
                $arr = explode(',', $val->plans);
                $isPurchase = array_intersect($arr,$myPlans);
                $plan = Plan::where('id', $val->plans)->first();
                if(count($isPurchase) > 0)
                $temp['purchase'] = true;
                else $temp['purchase'] = false;
                $temp['plan_name'] = $plan->name;
                $temp['name'] = $val->name;
                $temp['description'] = $val->description;
                $temp['thumbnail'] = $val->thumbnail;
                $temp['id'] = $val->id;
                $temp['file_type'] = $val->file_type;
                $temp['audio_file'] = $val->audio_file;
                $podcasts[] = $temp;
            }
            return view("frontend.podcast")->with(compact('podcasts'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function viewPodcast($id)
    {
        try{
            $id = encrypt_decrypt('decrypt', $id);
            $now = Carbon::now();
            $podcast = Podcast::where('id', $id)->first();
            return view("frontend.view-podcast")->with(compact('podcast'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function e_book()
    {
        try{
            $now = Carbon::now();
            $ebook = Ebook::orderByDesc('id')->get();
            if(isset(auth()->user()->id))
                $myPlans = UserPlanDetail::where('user_id', auth()->user()->id)->where('end_date', '>=', $now)->pluck('plan_id')->toArray();
            else $myPlans = array();
            $ebooks = [];
            foreach($ebook as $val){
                $arr = explode(',', $val->plans);
                $isPurchase = array_intersect($arr,$myPlans);
                $plan = Plan::where('id', $val->plans)->first();
                if(count($isPurchase) > 0)
                $temp['purchase'] = true;
                else $temp['purchase'] = false;
                $temp['plan_name'] = $plan->name;
                $temp['name'] = $val->name;
                $temp['description'] = $val->description;
                $temp['thumbnail'] = $val->thumbnail;
                $temp['pdf_file'] = $val->pdf_file;
                $ebooks[] = $temp;
            }
            return view("frontend.e-book")->with(compact('ebooks'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function signin()
    {
        return view("frontend.auth.signin");
    }

    public function signup()
    {
        return view("frontend.auth.signup");
    }

    public function contactSave()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'address' => 'required',
        ]);
        $contact = new Contact();
        $contact->name = request('name');
        $contact->email = request('email');
        $contact->message = request('message');
        $contact->phone = request('phone');

        $contact->address = request('address');
        $contact->save();
        return response()->json(['message' => 'Thanks for contact', 'status' => 200]);
    }
}
