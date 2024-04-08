<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function videos()
    {
        try{
            $data = Video::orderByDesc('id')->paginate(config("app.ebook_per_page"));
            return view("admin.content.video", compact("data"));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function videoSave(Request $request)
    {
        try{
            $request->validate(
                [
                    'title' => 'required',
                    "link" => 'required',
                ]
            );
            $video = new Video;
            $video->title = $request->title;
            $video->link = $request->link;
            $video->status = 1;
            $video->save();

            return response()->json([
                'message' => 'Youtube Video Added Successfully.',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function videoDelete($id)
    {
        try{
            $id = encrypt_decrypt('decrypt', $id);
            Video::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Video Deleted Successfully.');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function videoUpdate(Request $request)
    {
        try{
            $request->validate(
                [
                    'title' => 'required',
                    "link" => 'required',
                ]
            );
            $id = encrypt_decrypt('decrypt', $request->id);
            $video = Video::where('id', $id)->first();
            $video->title = $request->title;
            $video->link = $request->link;
            $video->status = 1;
            $video->save();

            return response()->json([
                'message' => 'Youtube Video Details Updated Successfully.',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
