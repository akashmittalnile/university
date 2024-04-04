<?php

namespace App\Http\Controllers;

use App\Models\BusinessLink;
use App\Models\Contact;
use App\Models\Content;
use App\Models\GalleryAttribute;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function about()
    {
        $content = Content::where("name", "about")->first();
        if (!$content) {
            $content = new Content();
            $content->name = 'about';
            $content->save();
        }
        $data = unserialize($content->value);
        return view("admin.content.about", compact('content', 'data'));
    }

    public function aboutSave(Request $request)
    {
        $request->validate(
            [
                'sec1_title' => 'required',
                "sec1_sub_title" => 'required',
                "sec1_image" => 'file|max:10240',
                'sec2_title' => 'required',
                "sec2_sub_title" => 'required',
                "sec2_image" => 'file|max:10240',
                'sec3_title' => 'required',
                "sec3_sub_title" => 'required',
                "sec3_image" => 'file|max:10240',
                'sec4_title' => 'required',
                "sec4_sub_title" => 'required',
                "sec4_image" => 'file|max:10240',
                'sec5_title' => 'required',
                "sec5_sub_title" => 'required',
                "sec5_image" => 'file|max:10240',
                'sec6_title' => 'required',
                "sec6_sub_title" => 'required',
                "sec6_image" => 'file|max:10240',
                'sec7_title' => 'required',
                "sec7_sub_title" => 'required',
                "sec7_image" => 'file|max:10240',
                'sec8_title' => 'required',
                "sec8_sub_title" => 'required',
                "sec8_image" => 'file|max:10240',
                'sec9_title' => 'required',
                "sec9_sub_title" => 'required',
                "sec9_image" => 'file|max:10240',
                "sec10_image" => 'file|max:10240',
            ]
        );
        $content = Content::where("name", "about")->first();
        if ($content) {
            $unser = unserialize($content->value);
            $name1 = $unser['sec1_image'] ?? null;
            $name2 = $unser['sec2_image'] ?? null;
            $name3 = $unser['sec3_image'] ?? null;
            $name4 = $unser['sec4_image'] ?? null;
            $name5 = $unser['sec5_image'] ?? null;
            $name6 = $unser['sec6_image'] ?? null;
            $name7 = $unser['sec7_image'] ?? null;
            $name8 = $unser['sec8_image'] ?? null;
            $name9 = $unser['sec9_image'] ?? null;
            $name10 = $unser['sec10_image'] ?? null;
            if ($request->hasFile("sec1_image")) {
                if (isset($unser['sec1_image'])) {
                    $link = public_path() . "/uploads/about/" . $unser['sec1_image'];
                    if (file_exists($link)) unlink($link);
                }
                $name1 = fileUpload($request->sec1_image, "uploads/about");
            }
            if ($request->hasFile("sec2_image")) {
                if (isset($unser['sec2_image'])) {
                    $link = public_path() . "/uploads/about/" . $unser['sec2_image'];
                    if (file_exists($link))
                        unlink($link);
                }
                $name2 = fileUpload($request->sec2_image, "uploads/about");
            }
            if ($request->hasFile("sec3_image")) {
                if (isset($unser['sec3_image'])) {
                    $link = public_path() . "/uploads/about/" . $unser['sec3_image'];
                    if (file_exists($link))
                        unlink($link);
                }
                $name3 = fileUpload($request->sec3_image, "uploads/about");
            }
            if ($request->hasFile("sec4_image")) {
                if (isset($unser['sec4_image'])) {
                    $link = public_path() . "/uploads/about/" . $unser['sec4_image'];
                    if (file_exists($link))
                        unlink($link);
                }
                $name4 = fileUpload($request->sec4_image, "uploads/about");
            }
            if ($request->hasFile("sec5_image")) {
                if (isset($unser['sec5_image'])) {
                    $link = public_path() . "/uploads/about/" . $unser['sec5_image'];
                    if (file_exists($link))
                        unlink($link);
                }
                $name5 = fileUpload($request->sec5_image, "uploads/about");
            }
            if ($request->hasFile("sec6_image")) {
                if (isset($unser['sec6_image'])) {
                    $link = public_path() . "/uploads/about/" . $unser['sec6_image'];
                    if (file_exists($link))
                        unlink($link);
                }
                $name6 = fileUpload($request->sec6_image, "uploads/about");
            }
            if ($request->hasFile("sec7_image")) {
                if (isset($unser['sec7_image'])) {
                    $link = public_path() . "/uploads/about/" . $unser['sec7_image'];
                    if (file_exists($link))
                        unlink($link);
                }
                $name7 = fileUpload($request->sec7_image, "uploads/about");
            }
            if ($request->hasFile("sec8_image")) {
                if (isset($unser['sec8_image'])) {
                    $link = public_path() . "/uploads/about/" . $unser['sec8_image'];
                    if (file_exists($link))
                        unlink($link);
                }
                $name8 = fileUpload($request->sec8_image, "uploads/about");
            }
            if ($request->hasFile("sec9_image")) {
                if (isset($unser['sec9_image'])) {
                    $link = public_path() . "/uploads/about/" . $unser['sec9_image'];
                    if (file_exists($link))
                        unlink($link);
                }
                $name9 = fileUpload($request->sec9_image, "uploads/about");
            }
            if ($request->hasFile("sec10_image")) {
                if (isset($unser['sec10_image'])) {
                    $link = public_path() . "/uploads/about/" . $unser['sec10_image'];
                    if (file_exists($link))
                        unlink($link);
                }
                $name10 = fileUpload($request->sec10_image, "uploads/about");
            }
            $val = array(
                'sec1_title' => $request->sec1_title,
                'sec1_sub_title' => $request->sec1_sub_title,
                'sec1_image' => $name1,
                'sec2_title' => $request->sec2_title,
                'sec2_sub_title' => $request->sec2_sub_title,
                'sec2_image' => $name2,
                'sec3_title' => $request->sec3_title,
                'sec3_sub_title' => $request->sec3_sub_title,
                'sec3_image' => $name3,
                'sec4_title' => $request->sec4_title,
                'sec4_sub_title' => $request->sec4_sub_title,
                'sec4_image' => $name4,
                'sec5_title' => $request->sec5_title,
                'sec5_sub_title' => $request->sec5_sub_title,
                'sec5_image' => $name5,
                'sec6_image' => $name6,

                'sec6_title' => $request->sec6_title,
                'sec6_sub_title' => $request->sec6_sub_title,
                'sec7_image' => $name7,

                'sec7_title' => $request->sec7_title,
                'sec7_sub_title' => $request->sec7_sub_title,
                'sec8_image' => $name8,

                'sec8_title' => $request->sec8_title,
                'sec8_sub_title' => $request->sec8_sub_title,
                'sec9_image' => $name9,

                'sec9_title' => $request->sec9_title,
                'sec9_sub_title' => $request->sec9_sub_title,
                'sec10_image' => $name10,
            );
            $content->value = serialize($val);
            $content->updated_at = date('Y-m-d H:i:s');
            $content->save();
        }
        return redirect()->back()->with('success', 'Content Updated Successfully');
    }

    public function about2()
    {
        $content = Content::where("name", "how_we_do_it")->first();
        if (!$content) {
            $content = new Content();
            $content->name = 'how_we_do_it';
            $content->save();
        }
        $data = unserialize($content->value);
        return view("admin.content.about2", compact("content", "data"));
    }

    public function aboutSave2(Request $request)
    {
        try {
            $request->validate(
                [
                    'sec1_title' => 'required',
                    "sec1_sub_title" => 'required',
                    "sec1_image" => 'file|max:10240',
                    'sec2_title' => 'required',
                    "sec2_sub_title" => 'required',
                    "sec2_image" => 'file|max:10240',
                    'sec3_title' => 'required',
                    "sec3_sub_title" => 'required',
                    "sec3_image" => 'file|max:10240',
                    'sec4_title' => 'required',
                    "sec4_sub_title" => 'required',
                    "sec4_image" => 'file|max:10240',
                    'sec5_title' => 'required',
                    "sec5_sub_title" => 'required',
                    "sec5_image" => 'file|max:10240',
                ]
            );
            $content = Content::where("name", "how_we_do_it")->first();
            if ($content) {
                $unser = unserialize($content->value);
                $name1 = $unser['sec1_image'] ?? null;
                $name2 = $unser['sec2_image'] ?? null;
                $name3 = $unser['sec3_image'] ?? null;
                $name4 = $unser['sec4_image'] ?? null;
                $name5 = $unser['sec5_image'] ?? null;
                if ($request->hasFile("sec1_image")) {
                    if (isset($unser['sec1_image'])) {
                        $link = public_path() . "/uploads/about/" . $unser['sec1_image'];
                        if (file_exists($link)) unlink($link);
                    }
                    $name1 = fileUpload($request->sec1_image, "uploads/about");
                }
                if ($request->hasFile("sec2_image")) {
                    if (isset($unser['sec2_image'])) {
                        $link = public_path() . "/uploads/about/" . $unser['sec2_image'];
                        if (file_exists($link))
                            unlink($link);
                    }
                    $name2 = fileUpload($request->sec2_image, "uploads/about");
                }
                if ($request->hasFile("sec3_image")) {
                    if (isset($unser['sec3_image'])) {
                        $link = public_path() . "/uploads/about/" . $unser['sec3_image'];
                        if (file_exists($link))
                            unlink($link);
                    }
                    $name3 = fileUpload($request->sec3_image, "uploads/about");
                }
                if ($request->hasFile("sec4_image")) {
                    if (isset($unser['sec4_image'])) {
                        $link = public_path() . "/uploads/about/" . $unser['sec4_image'];
                        if (file_exists($link))
                            unlink($link);
                    }
                    $name4 = fileUpload($request->sec4_image, "uploads/about");
                }
                if ($request->hasFile("sec5_image")) {
                    if (isset($unser['sec5_image'])) {
                        $link = public_path() . "/uploads/about/" . $unser['sec5_image'];
                        if (file_exists($link))
                            unlink($link);
                    }
                    $name5 = fileUpload($request->sec5_image, "uploads/about");
                }
                $val = array(
                    'sec_heading' => $request->sec_heading,
                    'sec1_title' => $request->sec1_title,
                    'sec1_sub_title' => $request->sec1_sub_title,
                    'sec1_image' => $name1,
                    'sec2_title' => $request->sec2_title,
                    'sec2_sub_title' => $request->sec2_sub_title,
                    'sec2_image' => $name2,
                    'sec3_title' => $request->sec3_title,
                    'sec3_sub_title' => $request->sec3_sub_title,
                    'sec3_image' => $name3,
                    'sec4_title' => $request->sec4_title,
                    'sec4_sub_title' => $request->sec4_sub_title,
                    'sec4_image' => $name4,
                    'sec5_title' => $request->sec5_title,
                    'sec5_sub_title' => $request->sec5_sub_title,
                    'sec5_image' => $name5,
                );
                $content->value = serialize($val);
                $content->updated_at = date('Y-m-d H:i:s');
                $content->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function markNetwork()
    {
        $content = Content::where("name", "mark-network")->first();
        if (!$content) {
            $content = new Content();
            $content->name = 'mark-network';
            $content->save();
        }
        $data = unserialize($content->value);
        return view("admin.content.mark-network", compact("content", "data"));
    }

    public function markNetworkSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'sec1_title' => 'required',
                    "sec1_sub_title" => 'required',
                    "sec1_image" => 'file|max:10240',
                    'sec2_title' => 'required',
                    "sec2_sub_title" => 'required',
                    "sec2_image" => 'file|max:10240',
                    'sec3_title' => 'required',
                    "sec3_sub_title" => 'required',
                    "sec3_image" => 'file|max:10240',
                ]
            );
            $content = Content::where("name", "mark-network")->first();
            if ($content) {
                $unser = unserialize($content->value);
                $name1 = $unser['sec1_image'] ?? null;
                $name2 = $unser['sec2_image'] ?? null;
                $name3 = $unser['sec3_image'] ?? null;
                if ($request->hasFile("sec1_image")) {
                    if (isset($unser['sec1_image'])) {
                        $link = public_path() . "/uploads/content/" . $unser['sec1_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name1 = fileUpload($request->sec1_image, "uploads/content");
                }
                if ($request->hasFile("sec2_image")) {
                    if (isset($unser['sec2_image'])) {
                        $link = public_path() . "/uploads/content/" . $unser['sec2_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name2 = fileUpload($request->sec2_image, "uploads/content");
                }
                if ($request->hasFile("sec3_image")) {
                    if (isset($unser['sec3_image'])) {
                        $link = public_path() . "/uploads/content/" . $unser['sec3_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name3 = fileUpload($request->sec3_image, "uploads/content");
                }
                $val = array(
                    'sec1_title' => $request->sec1_title,
                    'sec1_sub_title' => $request->sec1_sub_title,
                    'sec1_image' => $name1,
                    'sec2_title' => $request->sec2_title,
                    'sec2_sub_title' => $request->sec2_sub_title,
                    'sec2_image' => $name2,
                    'sec3_title' => $request->sec3_title,
                    'sec3_sub_title' => $request->sec3_sub_title,
                    'sec3_image' => $name3,
                );
                $content->value = serialize($val);
                $content->updated_at = date('Y-m-d H:i:s');
                $content->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function markBurnet()
    {
        $content = Content::where("name", "mark-burnet")->first();
        if (!$content) {
            $content = new Content();
            $content->name = 'mark-burnet';
            $content->save();
        }
        $data = unserialize($content->value);
        return view("admin.content.mark-burnet", compact("content", 'data'));
    }

    public function markBurnetSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'sec1_title' => 'required',
                    "sec1_sub_title" => 'required',
                    "sec1_image" => 'file|max:10240',
                    'sec2_title' => 'required',
                    "sec2_sub_title" => 'required',
                    "sec2_image" => 'file|max:10240',
                    'sec3_title' => 'required',
                    "sec3_sub_title" => 'required',
                    "sec3_image" => 'file|max:10240',
                ]
            );
            $content = Content::where("name", "mark-burnet")->first();
            if ($content) {
                $unser = unserialize($content->value);
                $name1 = $unser['sec1_image'] ?? null;
                $name2 = $unser['sec2_image'] ?? null;
                $name3 = $unser['sec3_image'] ?? null;
                if ($request->hasFile("sec1_image")) {
                    if (isset($unser['sec1_image'])) {
                        $link = public_path() . "/uploads/content/" . $unser['sec1_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name1 = fileUpload($request->sec1_image, "uploads/content");
                }
                if ($request->hasFile("sec2_image")) {
                    if (isset($unser['sec2_image'])) {
                        $link = public_path() . "/uploads/content/" . $unser['sec2_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name2 = fileUpload($request->sec2_image, "uploads/content");
                }
                if ($request->hasFile("sec3_image")) {
                    if (isset($unser['sec3_image'])) {
                        $link = public_path() . "/uploads/content/" . $unser['sec3_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name3 = fileUpload($request->sec3_image, "uploads/content");
                }
                $val = array(
                    'sec1_title' => $request->sec1_title,
                    'sec1_sub_title' => $request->sec1_sub_title,
                    'sec1_image' => $name1,
                    'sec2_title' => $request->sec2_title,
                    'sec2_sub_title' => $request->sec2_sub_title,
                    'sec2_image' => $name2,
                    'sec3_title' => $request->sec3_title,
                    'sec3_sub_title' => $request->sec3_sub_title,
                    'sec3_image' => $name3,
                );
                $content->value = serialize($val);
                $content->updated_at = date('Y-m-d H:i:s');
                $content->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function affiliate()
    {
        $content = Content::where("name", "affiliate")->first();
        if (!$content) {
            $content = new Content();
            $content->name = 'affiliate';
            $content->save();
        }
        $data = unserialize($content->value);
        return view("admin.content.affiliate", compact("content", "data"));
    }

    public function affiliateSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'sec1_title' => 'required',
                    "sec1_sub_title" => 'required',
                    "sec1_image" => 'file|max:10240',
                    'sec2_title' => 'required',
                    "sec2_sub_title" => 'required',
                    "sec2_image" => 'file|max:10240'
                ]
            );
            $content = Content::where("name", "affiliate")->first();
            if ($content) {
                $unser = unserialize($content->value);
                $name1 = $unser['sec1_image'] ?? null;
                $name2 = $unser['sec2_image'] ?? null;
                if ($request->hasFile("sec1_image")) {
                    if (isset($unser['sec1_image'])) {
                        $link = public_path() . "/uploads/content/" . $unser['sec1_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name1 = fileUpload($request->sec1_image, "uploads/content");
                }
                if ($request->hasFile("sec2_image")) {
                    if (isset($unser['sec2_image'])) {
                        $link = public_path() . "/uploads/content/" . $unser['sec2_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name2 = fileUpload($request->sec2_image, "uploads/content");
                }
                $val = array(
                    'sec1_title' => $request->sec1_title,
                    'sec1_sub_title' => $request->sec1_sub_title,
                    'sec1_image' => $name1,
                    'sec2_title' => $request->sec2_title,
                    'sec2_sub_title' => $request->sec2_sub_title,
                    'sec2_image' => $name2,
                );
                $content->value = serialize($val);
                $content->updated_at = date('Y-m-d H:i:s');
                $content->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function businessLinks()
    {
        $data = BusinessLink::orderByDesc("id")->paginate(config("app.ebook_per_page"));
        return view("admin.content.business-links", compact("data"));
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
                $name = fileUpload($request->image, "uploads/content");
                $link->image = $name;
            }
            $link->description = $request->description;
            $link->status = 1;
            $link->save();

            return response()->json([
                'message' => 'Business Link Created Successfully.',
                'status' => 200
            ]);
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
                    $link = public_path() . "/uploads/content/" . $links->image;
                    if (file_exists($link)) {
                        unlink($link);
                    }
                }
                $name = fileUpload($request->image, "uploads/content");
                $links->image = $name;
            }
            $links->description = $request->description;
            $links->status = 1;
            $links->save();

            return response()->json([
                'message' => 'Business Link Updated Successfully.',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function businessLinkDelete($id)
    {
        try {
            $id = encrypt_decrypt('decrypt', $id);
            $links = BusinessLink::where('id', $id)->first();

            $link = public_path() . "/uploads/content/" . $links->image;
            if (file_exists($link)) {
                unlink($link);
            }

            BusinessLink::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Business Link Deleted Successfully.');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function gallery()
    {
        $gallery = GalleryAttribute::orderByDesc('id')->paginate(config("app.ebook_per_page"));
        return view("admin.content.gallery", compact("gallery"));
    }

    public function gallerySave(Request $request)
    {
        if (isset($request->update)) {
            $id = encrypt_decrypt('decrypt', $request->id);
            $gallery = GalleryAttribute::where('id', $id)->first();
            if (isset($gallery->path)) {
                $link = public_path() . "/uploads/gallery/" . $gallery->path;
                if (File::exists($link)) {
                    unlink($link);
                }
            }
            $name = fileUpload($request->thumbnail, "uploads/gallery");
            GalleryAttribute::where('id', $id)->update(['path' => $name]);
            return redirect()->back()->with('success', 'Image Updated Successfully');
        } else {
            $array_of_image = json_decode($request->array_of_image);
            if (is_array($array_of_image) && count($array_of_image) > 0) {
                foreach ($array_of_image as $val) {
                    GalleryAttribute::create([
                        'type' => 'gallery_image',
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
            $name = fileUpload($request->file, "uploads/gallery");
            return response()->json(['status' => true, 'file_name' => $name, 'key' => 1]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function imageDelete(Request $request)
    {
        try {
            $filename =  $request->get('filename');
            $link = public_path() . "/uploads/gallery/" . $filename;
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
            $attr = GalleryAttribute::where('id', $id)->first();
            $link = public_path() . "/uploads/gallery/" . $attr->path;
            if (file_exists($link)) {
                unlink($link);
            }
            GalleryAttribute::where('id', $id)->delete();
            return redirect()->back()->with('idredirect',  1);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function resources()
    {
        $content = Content::where("name", "resources")->first();
        if (!$content) {
            $content = new Content();
            $content->name = 'resources';
            $content->save();
        }
        return view("admin.content.resources", compact("content"));
    }

    public function resourcesSave(Request $request)
    {
        $content = Content::where("name", "resources")->first();
        if ($content) {
            $content->value = $request->data;
            $content->updated_at = date('Y-m-d H:i:s');
            $content->save();
        }
        return redirect()->back()->with('success', 'Content Updated Successfully');
    }

    public function contacts(Request $request)
    {
        $contact = Contact::orderByDesc('id')->paginate(config("app.records_per_page"));
        return view("admin.content.contacts")->with(compact('contact'));
    }

    public function contactDownloadReport(Request $request)
    {
        $contact = Contact::orderByDesc('id')->get();
        return $this->downloadDownloadContactReportFile($contact);
    }

    public function businessHours(Request $request)
    {
        try {
            $content = Content::where("name", "business-hour")->first();
            if (!$content) {
                $content = new Content();
                $content->name = 'business-hour';
                $content->save();
            }
            $data = unserialize($content->value);
            return view("admin.content.business-hour")->with(compact('content', 'data'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function businessHourSave(Request $request)
    {
        try {
            $content = Content::where("name", "business-hour")->first();
            if ($content) {
                $content->value = serialize($request->all());
                $content->updated_at = date('Y-m-d H:i:s');
                $content->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function home(Request $request)
    {
        try {
            $content = Content::where("name", "home")->first();
            if (!$content) {
                $content = new Content();
                $content->name = 'home';
                $content->save();
            }
            $data = unserialize($content->value);
            return view("admin.content.home")->with(compact('content', 'data'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function homeSave(Request $request)
    {
        try {
            $request->validate(
                [
                    'banner_title' => 'required',
                    "banner_sub_title" => 'required',
                    "you_title" => 'required',
                    "you_link" => 'required',
                    "banner_image" => 'file|max:10240',
                ]
            );
            $content = Content::where("name", "home")->first();
            if ($content) {
                $unser = unserialize($content->value);
                $name = $unser['banner_image'] ?? null;
                if ($request->hasFile("banner_image")) {
                    if (isset($unser['banner_image'])) {
                        $link = public_path() . "/uploads/content/" . $unser['banner_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        }
                    }
                    $name = fileUpload($request->banner_image, "uploads/content");
                }
                $val = array(
                    'banner_title' => $request->banner_title,
                    'banner_sub_title' => $request->banner_sub_title,
                    'banner_image' => $name,
                    'you_title' => $request->you_title,
                    'you_link' => $request->you_link,
                );
                $content->value = serialize($val);
                $content->updated_at = date('Y-m-d H:i:s');
                $content->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function downloadDownloadContactReportFile($data)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="Contact Us "' . time() . '.csv');
        $output = fopen("php://output", "w");

        fputcsv($output, array('S.no', 'Name', 'Address', 'Message'));

        if (count($data) > 0) {
            foreach ($data as $key => $row) {
                $final = [
                    $key + 1,
                    $row->name ?? 'NA',
                    $row->email ?? 'NA',
                    (isset($row->phone) ? '+1 ' . $row->phone : 'NA'),
                    $row->address ?? 'NA',
                    $row->message ?? 'NA',
                ];
                fputcsv($output, $final);
            }
        }
    }

    public function socialMedia(Request $request)
    {
        try {
            $count = SocialMedia::where('status', 1)->count();
            $data = SocialMedia::where('status', 1)->orderByDesc('id')->paginate(config("app.records_per_page"));
            return view("admin.content.social-media")->with(compact('data', 'count'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function socialMediaSave(Request $request)
    {
        $request->validate(
            [
                'file' => 'required',
                "link" => 'required',
            ]
        );
        try {
            if ($request->hasFile("file")) {
                $name = fileUpload($request->file, "uploads/socialmedia");
            }
            $data = new SocialMedia;
            $data->image = $name ?? null;
            $data->link = $request->link ?? null;
            $data->status = 1;
            $data->save();
            return response()->json([
                'message' => 'New Social Media Link Created Successfully',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function socialMediaDelete($id)
    {
        try {
            $id = encrypt_decrypt('decrypt', $id);
            $data = SocialMedia::where('id', $id)->first();
            $link = public_path() . "/uploads/socialmedia/" . $data->image;
            if (file_exists($link)) {
                unlink($link);
            }
            SocialMedia::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Social Media Link Deleted Successfully.');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function socialMediaUpdate(Request $request)
    {
        $request->validate(
            [
                "link" => 'required',
            ]
        );
        try {
            $id = encrypt_decrypt('decrypt', $request->id);
            $data = SocialMedia::where('id', $id)->first();
            if ($request->hasFile("file")) {
                if (isset($data->image)) {
                    $link = public_path() . "/uploads/socialmedia/" . $data->image;
                    if (file_exists($link)) {
                        unlink($link);
                    }
                }
                $name = fileUpload($request->file, "uploads/socialmedia");
                $data->image = $name;
            }
            $data->link = $request->link ?? null;
            $data->status = 1;
            $data->save();
            return response()->json([
                'message' => 'Social Media Link Updated Successfully',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
