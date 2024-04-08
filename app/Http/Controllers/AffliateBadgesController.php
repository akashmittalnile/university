<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AffliateBadgesController extends Controller
{
    public function affiliateBadges()
    {
        try{
            $data = Badge::orderByDesc('id')->paginate(config("app.ebook_per_page"));
            return view("admin.content.affiliate-badges", compact("data"));
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

            return response()->json([
                'message' => 'Affiliate Badge Created Successfully.',
                'status' => 200
            ]);
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
            return redirect()->back()->with('success', 'Affiliate Badge Deleted Successfully.');
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

            return response()->json([
                'message' => 'Affiliate Badge Updated Successfully.',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
