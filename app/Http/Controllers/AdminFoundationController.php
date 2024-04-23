<?php

namespace App\Http\Controllers;

use App\Models\ManageFoundation;
use Illuminate\Http\Request;

class AdminFoundationController extends Controller
{
    public function markBurnett()
    {
        try {
            $data1 = ManageFoundation::where('section_code', 'partner')->first();
            $data2 = ManageFoundation::where('section_code', 'donate')->first();
            $data3 = ManageFoundation::where('section_code', 'product')->first();
            return view("admin.foundation.foundation", compact('data1', 'data2', 'data3'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function partnerSave(Request $request){
        try{
            $request->validate(
                [
                    'partner_title' => 'required',
                    "partner_description" => 'required',
                    "partner_image" => 'file|max:10240',
                ]
            );
            if (isset($request->partner_id) && $request->partner_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->partner_id);
                $about = ManageFoundation::where('id', $id)->where('section_code', 'partner')->first();
                if ($request->hasFile("partner_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/foundation/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->partner_image, "uploads/foundation");
                    $about->image1 = $name;
                }
                $about->title = $request->partner_title ?? null;
                $about->description = $request->partner_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageFoundation;
                if ($request->hasFile("partner_image")) {
                    $name = fileUpload($request->partner_image, "uploads/foundation");
                    $about->image1 = $name;
                }
                $about->section_code = 'partner';
                $about->title = $request->partner_title;
                $about->description = $request->partner_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function donateSave(Request $request){
        try{
            $request->validate(
                [
                    'donate_title' => 'required',
                    "donate_description" => 'required',
                    "donate_image" => 'file|max:10240',
                ]
            );
            if (isset($request->donate_id) && $request->donate_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->donate_id);
                $about = ManageFoundation::where('id', $id)->where('section_code', 'donate')->first();
                if ($request->hasFile("donate_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/foundation/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->donate_image, "uploads/foundation");
                    $about->image1 = $name;
                }
                $about->title = $request->donate_title ?? null;
                $about->description = $request->donate_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageFoundation;
                if ($request->hasFile("donate_image")) {
                    $name = fileUpload($request->donate_image, "uploads/foundation");
                    $about->image1 = $name;
                }
                $about->section_code = 'donate';
                $about->title = $request->donate_title;
                $about->description = $request->donate_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function productSave(Request $request){
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
                $about = ManageFoundation::where('id', $id)->where('section_code', 'product')->first();
                if ($request->hasFile("product_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/foundation/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->product_image, "uploads/foundation");
                    $about->image1 = $name;
                }
                $about->title = $request->product_title ?? null;
                $about->description = $request->product_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageFoundation;
                if ($request->hasFile("product_image")) {
                    $name = fileUpload($request->product_image, "uploads/foundation");
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
}
