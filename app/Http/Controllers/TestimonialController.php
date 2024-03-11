<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function testimonial()
    {
        try{
            $data = Testimonial::orderByDesc('id')->paginate(config("app.ebook_per_page"));
            return view("admin.content.testimonial", compact("data"));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
        
    }

    public function testimonialSave(Request $request)
    {
        try{
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

            return response()->json([
                'message' => 'Testimonial Created Successfully.',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function testimonialDelete($id)
    {
        try{
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
        try{
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
                if(isset($testimonials->image)){
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

            return response()->json([
                'message' => 'Testimonial Updated Successfully.',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
