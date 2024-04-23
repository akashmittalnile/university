<?php

namespace App\Http\Controllers;

use App\Models\ManageAboutUs;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class AdminAboutUsController extends Controller
{
    public function about()
    {
        try {
            $data1 = ManageAboutUs::where('section_code', 'vision')->first();
            $data2 = ManageAboutUs::where('section_code', 'story')->first();
            $data3 = ManageAboutUs::where('section_code', 'we_do')->first();
            $data4 = ManageAboutUs::where('section_code', 'select')->first();
            $data5 = ManageAboutUs::where('section_code', 'differ')->first();
            $data6 = ManageAboutUs::where('section_code', 'who_is')->first();
            $data7 = ManageAboutUs::where('section_code', 'global')->first();
            $data8 = ManageAboutUs::where('section_code', 'partner')->first();
            $data9 = ManageAboutUs::where('section_code', 'support')->first();
            $how = ManageAboutUs::where('section_code', 'how')->first();
            $how1 = ManageAboutUs::where('section_code', 'how1')->first();
            $how2 = ManageAboutUs::where('section_code', 'how2')->first();
            $how3 = ManageAboutUs::where('section_code', 'how3')->first();
            $how4 = ManageAboutUs::where('section_code', 'how4')->first();
            $how5 = ManageAboutUs::where('section_code', 'how5')->first();
            $team = TeamMember::orderByDesc('id')->get();
            return view("admin.about_us.about_us", compact('how', 'how1', 'how2', 'how3', 'how4', 'how5', 'data1', 'data2', 'data3', 'data4', 'data5', 'data6', 'data7', 'data8', 'data9', 'team'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function aboutVisionSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'vision_title' => 'required',
                    "vision_description" => 'required',
                    "vision_image" => 'file|max:10240',
                ]
            );
            if (isset($request->vision_id) && $request->vision_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->vision_id);
                $about = ManageAboutUs::where('id', $id)->where('section_code', 'vision')->first();
                if ($request->hasFile("vision_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/about/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->vision_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->title = $request->vision_title ?? null;
                $about->description = $request->vision_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageAboutUs;
                if ($request->hasFile("vision_image")) {
                    $name = fileUpload($request->vision_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->section_code = 'vision';
                $about->title = $request->vision_title;
                $about->description = $request->vision_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function aboutStorySave(Request $request)
    {
        try {
            $request->validate(
                [
                    'story_title' => 'required',
                    "story_description" => 'required',
                ]
            );
            if (isset($request->story_id) && $request->story_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->story_id);
                $about = ManageAboutUs::where('id', $id)->where('section_code', 'story')->first();
                $about->title = $request->story_title ?? null;
                $about->description = $request->story_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageAboutUs;
                $about->section_code = 'story';
                $about->title = $request->story_title;
                $about->description = $request->story_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function teamMemberSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => 'required',
                    'company_name' => 'required',
                    'designation' => 'required',
                    "image" => 'file|max:10240',
                ]
            );
            $team = new TeamMember;
            $team->name = $request->name;
            $team->designation = $request->designation;

            if ($request->hasFile("image")) {
                $name = fileUpload($request->image, "uploads/team");
                $team->image = $name;
            }
            $team->company_name = $request->company_name;
            $team->status = 1;
            $team->save();

            return redirect()->back()->with('success', 'Team Member Added Successfully.');
            // return response()->json([
            //     'message' => 'Team Member Added Successfully.',
            //     'status' => 200
            // ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function teamMemberDelete($id)
    {
        try {
            $id = encrypt_decrypt('decrypt', $id);
            $team = TeamMember::where('id', $id)->first();

            $link = public_path() . "/uploads/team/" . $team->image;
            if (file_exists($link)) {
                unlink($link);
            }

            TeamMember::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Team Member Deleted Successfully.');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function teamMemberUpdate(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => 'required',
                    'company_name' => 'required',
                    'designation' => 'required',
                    "image" => 'file|max:10240',
                ]
            );
            $id = encrypt_decrypt('decrypt', $request->id);
            $team = TeamMember::where('id', $id)->first();
            $team->name = $request->name;
            $team->designation = $request->designation;

            if ($request->hasFile("image")) {
                if (isset($team->image)) {
                    $link = public_path() . "/uploads/team/" . $team->image;
                    if (file_exists($link)) {
                        unlink($link);
                    }
                }
                $name = fileUpload($request->image, "uploads/team");
                $team->image = $name;
            }
            $team->company_name = $request->company_name;
            $team->status = 1;
            $team->save();

            return redirect()->back()->with('success', 'Team Member Updated Successfully.');
            // return response()->json([
            //     'message' => 'Team Member Updated Successfully.',
            //     'status' => 200
            // ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function aboutWeDoSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'we_do_title' => 'required',
                    "we_do_description" => 'required',
                    "we_do_image" => 'file|max:10240',
                ]
            );
            if (isset($request->we_do_id) && $request->we_do_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->we_do_id);
                $about = ManageAboutUs::where('id', $id)->where('section_code', 'we_do')->first();
                if ($request->hasFile("we_do_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/about/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->we_do_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->title = $request->we_do_title ?? null;
                $about->description = $request->we_do_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageAboutUs;
                if ($request->hasFile("we_do_image")) {
                    $name = fileUpload($request->we_do_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->section_code = 'we_do';
                $about->title = $request->we_do_title;
                $about->description = $request->we_do_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function aboutSelectSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'select_title' => 'required',
                    "select_description" => 'required',
                    "select_image" => 'file|max:10240',
                ]
            );
            if (isset($request->select_id) && $request->select_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->select_id);
                $about = ManageAboutUs::where('id', $id)->where('section_code', 'select')->first();
                if ($request->hasFile("select_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/about/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->select_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->title = $request->select_title ?? null;
                $about->description = $request->select_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageAboutUs;
                if ($request->hasFile("select_image")) {
                    $name = fileUpload($request->select_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->section_code = 'select';
                $about->title = $request->select_title;
                $about->description = $request->select_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function aboutDifferSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'differ_title' => 'required',
                    "differ_description" => 'required',
                    "differ_image" => 'file|max:10240',
                ]
            );
            if (isset($request->differ_id) && $request->differ_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->differ_id);
                $about = ManageAboutUs::where('id', $id)->where('section_code', 'differ')->first();
                if ($request->hasFile("differ_image1")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/about/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->differ_image1, "uploads/about");
                    $about->image1 = $name;
                }
                if ($request->hasFile("differ_image2")) {
                    if (isset($about->image2)) {
                        $link = public_path() . "/uploads/about/" . $about->image2;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->differ_image2, "uploads/about");
                    $about->image2 = $name;
                }
                $about->title = $request->differ_title ?? null;
                $about->description = $request->differ_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageAboutUs;
                if ($request->hasFile("differ_image1")) {
                    $name = fileUpload($request->differ_image1, "uploads/about");
                    $about->image1 = $name;
                }
                if ($request->hasFile("differ_image2")) {
                    $name = fileUpload($request->differ_image2, "uploads/about");
                    $about->image2 = $name;
                }
                $about->section_code = 'differ';
                $about->title = $request->differ_title;
                $about->description = $request->differ_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function aboutWhoIsSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'who_is_title' => 'required',
                    "who_is_description" => 'required',
                    "who_is_image" => 'file|max:10240',
                ]
            );
            if (isset($request->who_is_id) && $request->who_is_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->who_is_id);
                $about = ManageAboutUs::where('id', $id)->where('section_code', 'who_is')->first();
                if ($request->hasFile("who_is_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/about/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->who_is_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->title = $request->who_is_title ?? null;
                $about->description = $request->who_is_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageAboutUs;
                if ($request->hasFile("who_is_image")) {
                    $name = fileUpload($request->who_is_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->section_code = 'who_is';
                $about->title = $request->who_is_title;
                $about->description = $request->who_is_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function aboutGlobalSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'global_title' => 'required',
                    "global_description" => 'required',
                    "global_image" => 'file|max:10240',
                ]
            );
            if (isset($request->global_id) && $request->global_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->global_id);
                $about = ManageAboutUs::where('id', $id)->where('section_code', 'global')->first();
                if ($request->hasFile("global_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/about/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->global_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->title = $request->global_title ?? null;
                $about->description = $request->global_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageAboutUs;
                if ($request->hasFile("global_image")) {
                    $name = fileUpload($request->global_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->section_code = 'global';
                $about->title = $request->global_title;
                $about->description = $request->global_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function aboutPartnerSave(Request $request)
    {
        try {
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
                $about = ManageAboutUs::where('id', $id)->where('section_code', 'partner')->first();
                if ($request->hasFile("partner_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/about/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->partner_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->title = $request->partner_title ?? null;
                $about->description = $request->partner_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageAboutUs;
                if ($request->hasFile("partner_image")) {
                    $name = fileUpload($request->partner_image, "uploads/about");
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

    public function aboutSupportSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'support_title' => 'required',
                    "support_description" => 'required',
                    "support_image" => 'file|max:10240',
                ]
            );
            if (isset($request->support_id) && $request->support_id != '') {
                // dd($request->all());
                $id = encrypt_decrypt('decrypt', $request->support_id);
                $about = ManageAboutUs::where('id', $id)->where('section_code', 'support')->first();
                if ($request->hasFile("support_image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/about/" . $about->image1;
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->support_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->title = $request->support_title ?? null;
                $about->description = $request->support_description;
                $about->status = 1;
                $about->updated_at = date('Y-m-d H:i:s');
                $about->save();
            } else {
                $about = new ManageAboutUs;
                if ($request->hasFile("support_image")) {
                    $name = fileUpload($request->support_image, "uploads/about");
                    $about->image1 = $name;
                }
                $about->section_code = 'support';
                $about->title = $request->support_title;
                $about->description = $request->support_description;
                $about->status = 1;
                $about->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function aboutHowSave(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate(
                [
                    'how_head_title' => 'required',
                    'how_title1' => 'required',
                    "how_description1" => 'required',
                    "how_image1" => 'file|max:10240',
                    'how_title2' => 'required',
                    "how_description2" => 'required',
                    "how_image2" => 'file|max:10240',
                ]
            );
            if (isset($request->how_head_id) && $request->how_head_id != ''){
                $id = encrypt_decrypt('decrypt', $request->how_head_id);
                $about = ManageAboutUs::where('id', $id)->where('section_code', 'how')->update(['title'=> $request->how_head_title, 'updated_at'=> date('Y-m-d H:i:s')]);
            } else {
                ManageAboutUs::create(['title' => $request->how_head_title, 'section_code' => 'how', 'status' => 1]);
            }
            if (isset($request->how_id1) && $request->how_id1 != '') {
                $id = encrypt_decrypt('decrypt', $request->how_id1);
                $about = ManageAboutUs::where('id', $id)->where('section_code', 'how1')->first();
                $name = $about->image1;
                if ($request->hasFile("how_image1")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/about/" . $about->image1;
                        if (file_exists($link)) unlink($link);
                    }
                    $name = fileUpload($request->how_image1, "uploads/about");
                }
                ManageAboutUs::where('id', $id)->where('section_code', 'how1')->update(['title'=> $request->how_title1, 'description' => $request->how_description1, 'image1' => $name, 'updated_at'=> date('Y-m-d H:i:s')]);
            } else {
                if ($request->hasFile("how_image1")) {
                    $name = fileUpload($request->how_image1, "uploads/about");
                }
                ManageAboutUs::create(['title' => $request->how_title1, 'description' => $request->how_description1, 'image1' => $name, 'section_code' => 'how1', 'status' => 1]);
            }
            if (isset($request->how_id2) && $request->how_id2 != '') {
                $id = encrypt_decrypt('decrypt', $request->how_id2);
                $about = ManageAboutUs::where('id', $id)->where('section_code', 'how2')->first();
                $name = $about->image1;
                if ($request->hasFile("how_image2")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/about/" . $about->image1;
                        if (file_exists($link)) unlink($link);
                    }
                    $name = fileUpload($request->how_image2, "uploads/about");
                }
                ManageAboutUs::where('id', $id)->where('section_code', 'how2')->update(['title'=> $request->how_title2, 'description' => $request->how_description2, 'image1' => $name, 'updated_at'=> date('Y-m-d H:i:s')]);
            } else {
                if ($request->hasFile("how_image2")) {
                    $name = fileUpload($request->how_image2, "uploads/about");
                }
                ManageAboutUs::create(['title' => $request->how_title2, 'description' => $request->how_description2, 'image1' => $name, 'section_code' => 'how2', 'status' => 1]);
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
    
    public function aboutHow2Save(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate(
                [
                    'title' => 'required',
                    'description' => 'required',
                    'section' => 'required',
                    "image" => 'file|max:10240',
                ]
            );
            $id = encrypt_decrypt('decrypt', $request->id);
            if (isset($request->id) && $request->id != '' && $id != 0) {
                $about = ManageAboutUs::where('id', $id)->where('section_code', $request->section)->first();
                $name = $about->image1;
                if ($request->hasFile("image")) {
                    if (isset($about->image1)) {
                        $link = public_path() . "/uploads/about/" . $about->image1;
                        if (file_exists($link)) unlink($link);
                    }
                    $name = fileUpload($request->image, "uploads/about");
                }
                ManageAboutUs::where('id', $id)->where('section_code', $request->section)->update(['title'=> $request->title, 'description' => $request->description, 'image1' => $name, 'updated_at'=> date('Y-m-d H:i:s')]);
            } else {
                if ($request->hasFile("image")) {
                    $name = fileUpload($request->image, "uploads/about");
                }
                ManageAboutUs::create(['title' => $request->title, 'description' => $request->description, 'image1' => $name, 'section_code' => $request->section, 'status' => 1]);
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
