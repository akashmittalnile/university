<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Ebook;
use App\Models\Plan;
use App\Models\Podcast;
use App\Models\UserPlanDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
                $total += $item->plan->price;
            }
            return view("frontend.profile", compact('user', 'currentPlan', 'total'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function subscription()
    {
        try {
            $now = Carbon::now();
            $plans = Plan::orderBy("price", "asc")->get();
            $myPlans = UserPlanDetail::where('user_id', auth()->user()->id)->where('end_date', '>=', $now)->pluck('plan_id')->toArray();
            foreach ($plans as  $item) {
                if (in_array($item->id, $myPlans)) 
                    $item->current_plan = true;
                else
                    $item->current_plan = false;
                $item->description = explode(",", $item->description);
            }
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
        return view("index");
    }

    public function about()
    {
        $about = Content::where("name", 'about')->first();
        return view("frontend.about", compact('about'));
    }

    public function affiliate()
    {
        return view("frontend.affiliate");
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
        return view("frontend.accomplishment");
    }

    public function markNetwork()
    {
        $plans = Plan::orderBy("price", "asc")->get();
        foreach ($plans as  $item) {
            $item->description = explode(",", $item->description);
        }
        return view("frontend.mark-network", compact("plans"));
    }

    public function markBurnet()
    {
        return view("frontend.mark-burnet");
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
                if(count($isPurchase) > 0)
                $temp['purchase'] = true;
                else $temp['purchase'] = false;
                $temp['name'] = $val->name;
                $temp['description'] = $val->description;
                $temp['thumbnail'] = $val->thumbnail;
                $temp['pdf_file'] = $val->pdf_file;
                $ebooks[] = $temp;
            }
            foreach($podcast as $val){
                $arr = explode(',', $val->plans);
                $isPurchase = array_intersect($arr,$myPlans);
                if(count($isPurchase) > 0)
                $temp['purchase'] = true;
                else $temp['purchase'] = false;
                $temp['name'] = $val->name;
                $temp['description'] = $val->description;
                $temp['thumbnail'] = $val->thumbnail;
                $temp['id'] = $val->id;
                $temp['file_type'] = $val->file_type;
                $temp['audio_file'] = $val->audio_file;
                $podcasts[] = $temp;
            }
            return view("frontend.resources")->with(compact('podcasts', 'ebooks', 'blogs'));
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
                if(count($isPurchase) > 0)
                $temp['purchase'] = true;
                else $temp['purchase'] = false;
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
                if(count($isPurchase) > 0)
                $temp['purchase'] = true;
                else $temp['purchase'] = false;
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
