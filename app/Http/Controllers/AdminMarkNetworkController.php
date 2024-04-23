<?php

namespace App\Http\Controllers;

use App\Models\ManageMarkNetwork;
use Illuminate\Http\Request;

class AdminMarkNetworkController extends Controller
{
    public function markNetwork()
    {
        try {
            $data1 = ManageMarkNetwork::where('section_code', 'mentorship')->first();
            $data2 = ManageMarkNetwork::where('section_code', 'community')->first();
            $data3 = ManageMarkNetwork::where('section_code', 'member')->first();
            return view("admin.mark_network.mark-network", compact('data1', 'data2', 'data3'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function mentorShipSave(Request $request){
        try{
            $request->validate(
                [
                    'mentorship_title' => 'required',
                    "mentorship_description" => 'required',
                    "mentorship_image" => 'file|max:10240',
                ]
            );
            if (isset($request->mentorship_id) && $request->mentorship_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->mentorship_id);
                $about = ManageMarkNetwork::where('id', $id)->where('section_code', 'mentorship')->first();
                if ($request->hasFile("mentorship_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/mark-network/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->mentorship_image, "uploads/mark-network");
                    $about->image1 = $name;
                }
                $about->title = $request->mentorship_title ?? null;
                $about->description = $request->mentorship_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageMarkNetwork;
                if ($request->hasFile("mentorship_image")) {
                    $name = fileUpload($request->mentorship_image, "uploads/mark-network");
                    $about->image1 = $name;
                }
                $about->section_code = 'mentorship';
                $about->title = $request->mentorship_title;
                $about->description = $request->mentorship_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function communitySave(Request $request){
        try{
            $request->validate(
                [
                    'community_title' => 'required',
                    "community_description" => 'required',
                    "community_image" => 'file|max:10240',
                ]
            );
            if (isset($request->community_id) && $request->community_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->community_id);
                $about = ManageMarkNetwork::where('id', $id)->where('section_code', 'community')->first();
                if ($request->hasFile("community_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/mark-network/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->community_image, "uploads/mark-network");
                    $about->image1 = $name;
                }
                $about->title = $request->community_title ?? null;
                $about->description = $request->community_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageMarkNetwork;
                if ($request->hasFile("community_image")) {
                    $name = fileUpload($request->community_image, "uploads/mark-network");
                    $about->image1 = $name;
                }
                $about->section_code = 'community';
                $about->title = $request->community_title;
                $about->description = $request->community_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function memberSave(Request $request){
        try{
            $request->validate(
                [
                    'member_title' => 'required',
                    "member_description" => 'required',
                    "member_image" => 'file|max:10240',
                ]
            );
            if (isset($request->member_id) && $request->member_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->member_id);
                $about = ManageMarkNetwork::where('id', $id)->where('section_code', 'member')->first();
                if ($request->hasFile("member_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/mark-network/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->member_image, "uploads/mark-network");
                    $about->image1 = $name;
                }
                $about->title = $request->member_title ?? null;
                $about->description = $request->member_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageMarkNetwork;
                if ($request->hasFile("member_image")) {
                    $name = fileUpload($request->member_image, "uploads/mark-network");
                    $about->image1 = $name;
                }
                $about->section_code = 'member';
                $about->title = $request->member_title;
                $about->description = $request->member_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
