<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Video;
use App\Models\Badge;
use App\Models\Content;
use App\Models\ManageHome;
use App\Models\Plan;

class AdminHomeController extends Controller
{
    public function home(Request $request)
    {
        try {
            $data = ManageHome::where('status', 1);
            if($request->filled('search')) $data->where('section_code', 'LIKE', '%'. $request->search . '%');
            if($request->filled('date')) $data->whereDate('updated_at', $request->date);
            $datas = $data->paginate(config("app.records_per_page"));
            $test = Testimonial::orderByDesc('id')->get();
            $video = Video::orderByDesc('id')->get();
            $badges = Badge::orderByDesc('id')->get();
            $home = ManageHome::where('section_code', 'banner')->first();
            $community = ManageHome::where('section_code', 'community')->first();
            return view("admin.home.home")->with(compact('datas', 'test', 'badges', 'video', 'home', 'community'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function homeEdit(Request $request, $id)
    {
        try {
            $id = encrypt_decrypt('decrypt', $id);
            $home = ManageHome::where('id', $id)->first();
            if($home->section_code == 'banner') return view('admin.home.home-edit')->with(compact('home'));
            elseif($home->section_code == 'community') return view('admin.home.home-edit')->with(compact('home'));
            elseif($home->section_code == 'testimonial') return redirect()->route('admin.manage.testimonial');
            elseif($home->section_code == 'video') return redirect()->route('admin.manage.videos');
            elseif($home->section_code == 'achievement') return redirect()->route('admin.manage.affiliate-badges');
            else return redirect()->back()->with('error', 'Invalid section');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function homePreview(Request $request, $id)
    {
        try {
            $id = encrypt_decrypt('decrypt', $id);
            $home = ManageHome::where('id', $id)->first();
            $test = Testimonial::orderByDesc('id')->get();
            $video = Video::orderByDesc('id')->get();
            $badges = Badge::orderByDesc('id')->get();
            return view('admin.home.home-preview')->with(compact('home', 'test', 'badges', 'video'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function homeBannerSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'banner_id' => 'required',
                    'banner_title' => 'required',
                    "banner_description" => 'required',
                    "banner_image" => 'file|max:10240',
                ]
            );
            $id = encrypt_decrypt('decrypt', $request->banner_id);
            $home = ManageHome::where('id', $id)->first();
            if ($request->hasFile("banner_image")) {
                if (isset($home->image)) {
                    $link = public_path() . "/uploads/home/" . $home->image;
                    if (file_exists($link)) {
                        unlink($link);
                    }
                }
                $name = fileUpload($request->banner_image, "uploads/home");
                $home->image = $name;
            }
            $home->title = $request->banner_title;
            $home->description = $request->banner_description;
            $home->status = 1;
            $home->updated_at = date('Y-m-d H:i:s');
            $home->save();
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function homeCommunitySave(Request $request)
    {
        try {
            $request->validate(
                [
                    'community_id' => 'required',
                    'community_title' => 'required',
                    "community_description" => 'required',
                    "community_image" => 'file|max:10240',
                ]
            );
            $id = encrypt_decrypt('decrypt', $request->community_id);
            $home = ManageHome::where('id', $id)->first();
            if ($request->hasFile("community_image")) {
                if (isset($home->image)) {
                    $link = public_path() . "/uploads/home/" . $home->image;
                    if (file_exists($link)) {
                        unlink($link);
                    }
                }
                $name = fileUpload($request->community_image, "uploads/home");
                $home->image = $name;
            }
            $home->title = $request->community_title;
            $home->description = $request->community_description;
            $home->status = 1;
            $home->updated_at = date('Y-m-d H:i:s');
            $home->save();
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function testimonial()
    {
        try {
            $data = Testimonial::orderByDesc('id')->paginate(config("app.ebook_per_page"));
            return view("admin.home.testimonial", compact("data"));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function testimonialSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'title' => 'required',
                    'description' => 'required',
                    'designation' => 'required',
                    "image" => 'file|max:10240',
                ]
            );
            $testimonials = new Testimonial;
            $testimonials->title = $request->title;
            $testimonials->designation = $request->designation;

            if ($request->hasFile("image")) {
                $name = fileUpload($request->image, "uploads/testimonial");
                $testimonials->image = $name;
            }
            $testimonials->description = $request->description;
            $testimonials->status = 1;
            $testimonials->save();

            return redirect()->back()->with('success', 'Testimonial Created Successfully.');
            // return response()->json([
            //     'message' => 'Testimonial Created Successfully.',
            //     'status' => 200
            // ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function testimonialDelete($id)
    {
        try {
            $id = encrypt_decrypt('decrypt', $id);
            $testimonial = Testimonial::where('id', $id)->first();

            $link = public_path() . "/uploads/testimonial/" . $testimonial->image;
            if (file_exists($link)) {
                unlink($link);
            }

            Testimonial::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Testimonial Deleted Successfully.');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function testimonialUpdate(Request $request)
    {
        try {
            $request->validate(
                [
                    'title' => 'required',
                    'description' => 'required',
                    'designation' => 'required',
                    "image" => 'file|max:10240',
                ]
            );
            $id = encrypt_decrypt('decrypt', $request->id);
            $testimonials = Testimonial::where('id', $id)->first();
            $testimonials->title = $request->title;
            $testimonials->designation = $request->designation;

            if ($request->hasFile("image")) {
                if (isset($testimonials->image)) {
                    $link = public_path() . "/uploads/testimonial/" . $testimonials->image;
                    if (file_exists($link)) {
                        unlink($link);
                    }
                }
                $name = fileUpload($request->image, "uploads/testimonial");
                $testimonials->image = $name;
            }
            $testimonials->description = $request->description;
            $testimonials->status = 1;
            $testimonials->save();

            return redirect()->back()->with('success', 'Testimonial Updated Successfully.');
            // return response()->json([
            //     'message' => 'Testimonial Updated Successfully.',
            //     'status' => 200
            // ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function videos()
    {
        try{
            $data = Video::orderByDesc('id')->paginate(config("app.ebook_per_page"));
            return view("admin.home.video", compact("data"));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function videoSave(Request $request)
    {
        try{
            $request->validate(
                [
                    'title' => 'required',
                    "link" => 'required',
                ]
            );
            $video = new Video;
            $video->title = $request->title;
            $video->link = $request->link;
            $video->status = 1;
            $video->save();

            return redirect()->back()->with('success', 'Youtube Video Added Successfully.');
            // return response()->json([
            //     'message' => 'Youtube Video Added Successfully.',
            //     'status' => 200
            // ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function videoDelete($id)
    {
        try{
            $id = encrypt_decrypt('decrypt', $id);
            Video::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Video Deleted Successfully.');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function videoUpdate(Request $request)
    {
        try{
            $request->validate(
                [
                    'title' => 'required',
                    "link" => 'required',
                ]
            );
            $id = encrypt_decrypt('decrypt', $request->id);
            $video = Video::where('id', $id)->first();
            $video->title = $request->title;
            $video->link = $request->link;
            $video->status = 1;
            $video->save();

            return redirect()->back()->with('success', 'Youtube Video Details Updated Successfully.');
            // return response()->json([
            //     'message' => 'Youtube Video Details Updated Successfully.',
            //     'status' => 200
            // ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function affiliateBadges()
    {
        try{
            $data = Badge::orderByDesc('id')->paginate(config("app.ebook_per_page"));
            return view("admin.home.affiliate-badges", compact("data"));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
        
    }

    public function imageSave(Request $request)
    {
        try{
            $request->validate(
                [
                    'title' => 'required',
                    'description' => 'required',
                    "image" => 'file|max:10240',
                ]
            );
            $image = new Badge;
            $image->title = $request->title;
            
            if ($request->hasFile("image")) {
                $name = fileUpload($request->image, "uploads/badges");
                $image->path = $name;
            }
            $image->description = $request->description;
            $image->status = 1;
            $image->save();

            return redirect()->back()->with('success', 'Key Achievement Created Successfully.');
            // return response()->json([
            //     'message' => 'Achievement Created Successfully.',
            //     'status' => 200
            // ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function imageDelete($id)
    {
        try{
            $id = encrypt_decrypt('decrypt', $id);
            $image = Badge::where('id', $id)->first();

            $link = public_path() . "/uploads/badges/" . $image->path;
            if (file_exists($link)) {
                unlink($link);
            }

            Badge::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Key Achievement Deleted Successfully.');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function imageUpdate(Request $request)
    {
        try{
            $request->validate(
                [
                    'title' => 'required',
                    'description' => 'required',
                    "image" => 'file|max:10240',
                ]
            );
            $id = encrypt_decrypt('decrypt', $request->id);
            $image = Badge::where('id', $id)->first();
            $image->title = $request->title;
            
            if ($request->hasFile("image")) {
                if(isset($image->path)){
                    $link = public_path() . "/uploads/badges/" . $image->path;
                    if (file_exists($link)) {
                        unlink($link);
                    }
                }
                $name = fileUpload($request->image, "uploads/badges");
                $image->path = $name;
            }

            $image->description = $request->description;
            $image->status = 1;
            $image->save();

            return redirect()->back()->with('success', 'Key Achievement Updated Successfully.');
            // return response()->json([
            //     'message' => 'Achievement Updated Successfully.',
            //     'status' => 200
            // ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
