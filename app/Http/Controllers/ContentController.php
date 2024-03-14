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
        return view("admin.content.about", compact('content'));
    }

    public function aboutSave(Request $request)
    {
        if(isset($request->data)){
            $content = Content::where("name", "about")->first();
            if ($content) {

                $content->value = $request->data;
                $content->updated_at = date('Y-m-d H:i:s');
                $content->save();
            }
            return redirect()->back()->with('success', 'Content Updated Successfully');  
        } else {
            return redirect()->back()->with('error', 'Please enter some content!');  
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
        try{
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
                    if(isset($unser['sec1_image'])){
                       $link = public_path() . "/uploads/content/" . $unser['sec1_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        } 
                    }
                    $name1 = fileUpload($request->sec1_image, "uploads/content");
                }
                if ($request->hasFile("sec2_image")) {
                    if(isset($unser['sec2_image'])){
                       $link = public_path() . "/uploads/content/" . $unser['sec2_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        } 
                    }
                    $name2 = fileUpload($request->sec2_image, "uploads/content");
                }
                if ($request->hasFile("sec3_image")) {
                    if(isset($unser['sec3_image'])){
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
        try{
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
                    if(isset($unser['sec1_image'])){
                       $link = public_path() . "/uploads/content/" . $unser['sec1_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        } 
                    }
                    $name1 = fileUpload($request->sec1_image, "uploads/content");
                }
                if ($request->hasFile("sec2_image")) {
                    if(isset($unser['sec2_image'])){
                       $link = public_path() . "/uploads/content/" . $unser['sec2_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        } 
                    }
                    $name2 = fileUpload($request->sec2_image, "uploads/content");
                }
                if ($request->hasFile("sec3_image")) {
                    if(isset($unser['sec3_image'])){
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
        try{
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
                    if(isset($unser['sec1_image'])){
                       $link = public_path() . "/uploads/content/" . $unser['sec1_image'];
                        if (file_exists($link)) {
                            unlink($link);
                        } 
                    }
                    $name1 = fileUpload($request->sec1_image, "uploads/content");
                }
                if ($request->hasFile("sec2_image")) {
                    if(isset($unser['sec2_image'])){
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
        try{
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
        try{
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
                if(isset($links->image)){
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
        try{
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
        if(isset($request->update)){
            $id = encrypt_decrypt('decrypt', $request->id);
            $gallery = GalleryAttribute::where('id', $id)->first();
            if(isset($gallery->path)){
               $link = public_path() . "/uploads/gallery/" . $gallery->path;
                if (File::exists($link)) {
                    unlink($link);
                } 
            }
            $name = fileUpload($request->thumbnail, "uploads/gallery");
            GalleryAttribute::where('id', $id)->update(['path'=> $name]);
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
        try{
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
        try{
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
        try{
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
        try{
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
                    if(isset($unser['banner_image'])){
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
                        (isset($row->phone) ? '+1 '.$row->phone : 'NA' ),
                        $row->address ?? 'NA',
                        $row->message ?? 'NA',
                    ];
                fputcsv($output, $final);
            }
        }
    }

    public function socialMedia(Request $request)
    {
        try{
            $data = SocialMedia::where('status', 1)->orderByDesc('id')->paginate(config("app.records_per_page"));
            return view("admin.content.social-media")->with(compact('data'));
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
        try{
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
        try{
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
        try{
            $id = encrypt_decrypt('decrypt', $request->id);
            $data = SocialMedia::where('id', $id)->first();
            if ($request->hasFile("file")) {
                if(isset($data->image)){
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
