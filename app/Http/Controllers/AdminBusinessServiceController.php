<?php

namespace App\Http\Controllers;

use App\Models\BusinessLink;
use App\Models\ManageBusinessService;
use Illuminate\Http\Request;

class AdminBusinessServiceController extends Controller
{
    public function affiliate()
    {
        try {
            $data1 = ManageBusinessService::where('section_code', 'training')->first();
            $data2 = ManageBusinessService::where('section_code', 'product')->first();
            $data = BusinessLink::orderByDesc("id")->orderByDesc('id')->get();
            return view("admin.business_service.business-service", compact('data1', 'data2', 'data'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function affiliateTrainingSave(Request $request){
        try{
            $request->validate(
                [
                    'training_title' => 'required',
                    "training_description" => 'required',
                    "training_image" => 'file|max:10240',
                ]
            );
            if (isset($request->training_id) && $request->training_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->training_id);
                $about = ManageBusinessService::where('id', $id)->where('section_code', 'training')->first();
                if ($request->hasFile("training_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/business-service/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->training_image, "uploads/business-service");
                    $about->image1 = $name;
                }
                $about->title = $request->training_title ?? null;
                $about->description = $request->training_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageBusinessService;
                if ($request->hasFile("training_image")) {
                    $name = fileUpload($request->training_image, "uploads/business-service");
                    $about->image1 = $name;
                }
                $about->section_code = 'training';
                $about->title = $request->training_title;
                $about->description = $request->training_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function affiliateProductSave(Request $request){
        try{
            $request->validate(
                [
                    'product_title' => 'required',
                    "product_description" => 'required',
                    "product_image" => 'file|max:10240',
                ]
            );
            if (isset($request->product_id) && $request->product_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->product_id);
                $about = ManageBusinessService::where('id', $id)->where('section_code', 'product')->first();
                if ($request->hasFile("product_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/business-service/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->product_image, "uploads/business-service");
                    $about->image1 = $name;
                }
                $about->title = $request->product_title ?? null;
                $about->description = $request->product_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageBusinessService;
                if ($request->hasFile("product_image")) {
                    $name = fileUpload($request->product_image, "uploads/business-service");
                    $about->image1 = $name;
                }
                $about->section_code = 'product';
                $about->title = $request->product_title;
                $about->description = $request->product_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function businessLinkSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'title' => 'required',
                    "description" => 'required',
                    "image" => 'file|max:10240',
                    'link' => 'required',
                ]
            );
            $link = new BusinessLink;
            $link->title = $request->title;
            $link->links = $request->link;

            if ($request->hasFile("image")) {
                $name = fileUpload($request->image, "uploads/business-service");
                $link->image = $name;
            }
            $link->description = $request->description;
            $link->status = 1;
            $link->save();

            return redirect()->back()->with('success', 'Business Link Created Successfully.');
            // return response()->json([
            //     'message' => 'Business Link Created Successfully.',
            //     'status' => 200
            // ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function businessLinkUpdate(Request $request)
    {
        try {
            $request->validate(
                [
                    'title' => 'required',
                    "description" => 'required',
                    "image" => 'file|max:10240',
                    'link' => 'required',
                ]
            );
            $id = encrypt_decrypt('decrypt', $request->id);
            $links = BusinessLink::where('id', $id)->first();
            $links->title = $request->title;
            $links->links = $request->link;

            if ($request->hasFile("image")) {
                if (isset($links->image)) {
                    $link = public_path() . "/uploads/business-service/" . $links->image;
                    if (file_exists($link)) {
                        unlink($link);
                    }
                }
                $name = fileUpload($request->image, "uploads/business-service");
                $links->image = $name;
            }
            $links->description = $request->description;
            $links->status = 1;
            $links->save();

            return redirect()->back()->with('success', 'Business Link Updated Successfully.');
            // return response()->json([
            //     'message' => 'Business Link Updated Successfully.',
            //     'status' => 200
            // ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function businessLinkDelete($id)
    {
        try {
            $id = encrypt_decrypt('decrypt', $id);
            $links = BusinessLink::where('id', $id)->first();

            $link = public_path() . "/uploads/business-service/" . $links->image;
            if (file_exists($link)) {
                unlink($link);
            }

            BusinessLink::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Business Link Deleted Successfully.');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
