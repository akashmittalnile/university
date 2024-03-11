<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function image()
    {
        $gallery = Image::orderByDesc('id')->paginate(config("app.ebook_per_page"));
        return view("admin.content.image", compact("gallery"));
    }

    public function imageSave(Request $request)
    {
        if(isset($request->update)){
            $id = encrypt_decrypt('decrypt', $request->id);
            $gallery = Image::where('id', $id)->first();
            if(isset($gallery->path)){
               $link = public_path() . "/uploads/images/" . $gallery->path;
                if (File::exists($link)) {
                    unlink($link);
                } 
            }
            $name = fileUpload($request->thumbnail, "uploads/images");
            Image::where('id', $id)->update(['path'=> $name]);
            return redirect()->back()->with('success', 'Image Updated Successfully');
        } else {
            $array_of_image = json_decode($request->array_of_image);
            if (is_array($array_of_image) && count($array_of_image) > 0) {
                foreach ($array_of_image as $val) {
                    Image::create([
                        'type' => 'image',
                        'status' => 1,
                        'path' => $val
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Image Added Successfully');
        }
    }

    public function imageUpload(Request $request)
    {
        try {
            $name = fileUpload($request->file, "uploads/images");
            return response()->json(['status' => true, 'file_name' => $name, 'key' => 1]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function imageDelete(Request $request)
    {
        try {
            $filename =  $request->get('filename');
            $link = public_path() . "/uploads/images/" . $filename;
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
            $attr = Image::where('id', $id)->first();
            $link = public_path() . "/uploads/images/" . $attr->path;
            if (file_exists($link)) {
                unlink($link);
            }
            Image::where('id', $id)->delete();
            return redirect()->back()->with('idredirect',  1);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
