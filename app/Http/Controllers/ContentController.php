<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Content;
use App\Models\GalleryAttribute;
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

        $content = Content::where("name", "about")->first();
        if ($content) {

            $content->value = $request->data;
            $content->updated_at = date('Y-m-d H:i:s');
            $content->save();
        }
        return redirect()->back()->with('success', 'Content Updated Successfully');
    }

    public function markNetwork()
    {
        $content = Content::where("name", "mark-network")->first();
        if (!$content) {
            $content = new Content();
            $content->name = 'mark-network';
            $content->save();
        }
        return view("admin.content.mark-network", compact("content"));
    }

    public function markNetworkSave(Request $request)
    {
        $content = Content::where("name", "mark-network")->first();
        if ($content) {
            $content->value = $request->data;
            $content->updated_at = date('Y-m-d H:i:s');
            $content->save();
        }
        return redirect()->back()->with('success', 'Content Updated Successfully');
    }

    public function markBurnet()
    {
        $content = Content::where("name", "mark-burnet")->first();
        if (!$content) {
            $content = new Content();
            $content->name = 'mark-burnet';
            $content->save();
        }
        return view("admin.content.mark-burnet", compact("content"));
    }

    public function markBurnetSave(Request $request)
    {
        $content = Content::where("name", "mark-burnet")->first();
        if ($content) {
            $content->value = $request->data;
            $content->updated_at = date('Y-m-d H:i:s');
            $content->save();
        }
        return redirect()->back()->with('success', 'Content Updated Successfully');
    }

    public function affiliate()
    {
        $content = Content::where("name", "affiliate")->first();
        if (!$content) {
            $content = new Content();
            $content->name = 'affiliate';
            $content->save();
        }
        return view("admin.content.affiliate", compact("content"));
    }

    public function affiliateSave(Request $request)
    {
        $content = Content::where("name", "affiliate")->first();
        if ($content) {
            $content->value = $request->data;
            $content->updated_at = date('Y-m-d H:i:s');
            $content->save();
        }
        return redirect()->back()->with('success', 'Content Updated Successfully');
    }

    public function gallery()
    {
        $gallery = GalleryAttribute::orderByDesc('id')->paginate(config("app.ebook_per_page"));
        return view("admin.content.gallery", compact("gallery"));
    }

    public function gallerySave(Request $request)
    {
        if(isset($request->update)){
            $uid = uniqid();
            $id = encrypt_decrypt('decrypt', $request->id);
            $gallery = GalleryAttribute::where('id', $id)->first();
            $file = $request->file('thumbnail');
            $name = "gallery_" .  $uid . "." . $file->getClientOriginalExtension();
            $link = public_path() . "/uploads/gallery/" . $gallery->path;
            if (File::exists($link)) {
                unlink($link);
            }
            $file->move("uploads/gallery", $name);
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
            $uid = uniqid();
            $file = $request->file('file');
            $name = "gallery_" .  $uid . "." . $file->getClientOriginalExtension();
            $file->move("uploads/gallery", $name);
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
}
