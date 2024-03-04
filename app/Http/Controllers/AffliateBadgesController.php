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
            $gallery = Badge::orderByDesc('id')->paginate(config("app.ebook_per_page"));
            return view("admin.content.affiliate-badges", compact("gallery"));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
        
    }

    public function imageSave(Request $request)
    {
        try{
            if(isset($request->update)){
                $uid = uniqid();
                $id = encrypt_decrypt('decrypt', $request->id);
                $gallery = Badge::where('id', $id)->first();
                $file = $request->file('thumbnail');
                $name = $gallery->path;
                $link = public_path() . "/uploads/badges/" . $gallery->path;
                if (File::exists($link)) {
                    unlink($link);
                }
                $file->move("uploads/badges", $name);
                Badge::where('id', $id)->update(['path'=> $name]);
                return redirect()->back()->with('success', 'Image Updated Successfully');
            } else {
                $array_of_image = json_decode($request->array_of_image);
                if (is_array($array_of_image) && count($array_of_image) > 0) {
                    foreach ($array_of_image as $val) {
                        Badge::create([
                            'type' => 'image',
                            'status' => 1,
                            'path' => $val
                        ]);
                    }
                }
                return redirect()->back()->with('success', 'Image Added Successfully');
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function imageUpload(Request $request)
    {
        try {
            $uid = uniqid();
            $file = $request->file('file');
            $name = "image_" .  $uid . "." . $file->getClientOriginalExtension();
            $file->move("uploads/badges", $name);
            return response()->json(['status' => true, 'file_name' => $name, 'key' => 1]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function imageDelete(Request $request)
    {
        try {
            $filename =  $request->get('filename');
            $link = public_path() . "/uploads/badges/" . $filename;
            if (File::exists($link)) {
                unlink($link);
                return response()->json(['status' => true, 'file_name' => $filename, 'key' => 2]);
            }
            return response()->json(['status' => false, 'file_name' => $filename, 'key' => 2]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function uploadedImageDelete($id)
    {
        try {
            $id = encrypt_decrypt('decrypt', $id);
            $attr = Badge::where('id', $id)->first();
            $link = public_path() . "/uploads/badges/" . $attr->path;
            if (file_exists($link)) {
                unlink($link);
            }
            Badge::where('id', $id)->delete();
            return redirect()->back()->with('idredirect',  1);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
