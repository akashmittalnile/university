<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = Podcast::count();
        $podcasts = Podcast::when(request()->has('search'), function ($query) {
            $name = request('search');
            return $query->where("name", "LIKE", "%$name%");
        })->orderBy("id", "desc")->paginate(config("app.ebook_per_page"));
        return view('admin.podcasts.index', compact("podcasts", "count"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $podcast = null;
        $plans = Plan::orderBy("price", "asc")->get();
        return view('admin.podcasts.create', compact('podcast', 'plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:podcasts,name',
                "audio_file" => 'required',
                "thumbnail" => 'required|file|max:10240',
            ]
        );

        try {
            if (!$request->has('plans')) {
                return response()->json([
                    'message' => 'Please select atleast one plan.',
                    'status' => 201
                ]);
            }

            $podcast = new Podcast();
            $podcast->name = $request->name;
            $podcast->plans = implode(",", $request->plans);
            $uid = uniqid();
            if ($request->fileType==1 && $request->hasFile("audio_file")) {
                $file = $request->file('audio_file');
                $name = "podcast_" .  $uid . "." . $file->getClientOriginalExtension();
                $sizeInBytes = $file->getSize();
                $podcast->file_type = $request->fileType;
                $podcast->audio_file = $name;
                if ($sizeInBytes < 1048576) { // 1 MB = 1024 * 1024 bytes
                    $sizeInKB = round($sizeInBytes / 1024, 2);
                    $podcast->audio_file_size = "$sizeInKB KB";
                } else {
                    $sizeInMB = round($sizeInBytes / 1048576, 2);
                    $podcast->audio_file_size = "$sizeInMB MB";
                }
                $file->move("uploads/podcasts", $name);
            } else if($request->fileType==2 && isset($request->audio_file)) {
                $podcast->file_type = $request->fileType;
                $podcast->audio_file = $request->audio_file;
                $podcast->audio_file_size = "0 KB";
            }

            if ($request->hasFile("thumbnail")) {
                $file = $request->file('thumbnail');
                $name = "podcast_" .  $uid . "." . $file->getClientOriginalExtension();
                $podcast->thumbnail = $name;
                $file->move("uploads/podcasts", $name);
            }
            $podcast->description = $request->description;
            $podcast->cancellation_policy = $request->cancellation_policy;
            $podcast->save();

            return response()->json([
                'message' => 'Podcast Created Successfully.',
                'status' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 201
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Podcast $podcast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = encrypt_decrypt('decrypt', $id);
        $plans = Plan::orderBy("price", "asc")->get();
        $podcast = Podcast::where('id', $id)->first();
        $podcast->plans = explode(",", $podcast->plans);
        return view('admin.podcasts.edit', compact('podcast', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                "thumbnail" => 'file|max:10240',
            ]
        );
        try {
            $id = encrypt_decrypt('decrypt', $id);
            $podcast = Podcast::where('id', $id)->first();
            $podcast->name = $request->name;
            if (!$request->has('plans')) {
                return response()->json([
                    'message' => 'Please select atleast one plan.',
                    'status' => 201
                ]);
            }
            $podcast->plans = implode(",", $request->plans);
            $uid = uniqid();
            if ($request->fileType==1 && $request->hasFile("audio_file")) {
                $file = $request->file('audio_file');
                $name = "podcast_" .  $uid . "." . $file->getClientOriginalExtension();
                $sizeInBytes = $file->getSize();

                $link = public_path() . "/uploads/podcasts/" . $podcast->audio_file;
                if (file_exists($link)) {
                    unlink($link);
                }
                $podcast->file_type = $request->fileType;
                $podcast->audio_file = $name;
                if ($sizeInBytes < 1048576) { // 1 MB = 1024 * 1024 bytes
                    $sizeInKB = round($sizeInBytes / 1024, 2);
                    $podcast->audio_file_size = "$sizeInKB KB";
                } else {
                    $sizeInMB = round($sizeInBytes / 1048576, 2);
                    $podcast->audio_file_size = "$sizeInMB MB";
                }
                $file->move("uploads/podcasts", $name);
            } else if($request->fileType==2 && isset($request->audio_file)) {
                $podcast->file_type = $request->fileType;
                $podcast->audio_file = $request->audio_file;
                $podcast->audio_file_size = "0 KB";
            }

            if ($request->hasFile("thumbnail")) {
                $file = $request->file('thumbnail');
                $name = "podcast_" .  $uid . "." . $file->getClientOriginalExtension();

                $link = public_path() . "/uploads/podcasts/" . $podcast->thumbnail;
                if (file_exists($link)) {
                    unlink($link);
                }

                $podcast->thumbnail = $name;
                $file->move("uploads/podcasts", $name);
            }
            $podcast->description = $request->description;
            $podcast->cancellation_policy = $request->cancellation_policy;
            $podcast->status = 1;
            $podcast->updated_at = date('Y-m-d H:i:s');
            $podcast->save();

            return response()->json([
                'message' => 'Podcast Updated Successfully.',
                'status' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 201
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = encrypt_decrypt('decrypt', $id);
        $podcast = Podcast::where('id', $id)->first();
        $link1 = public_path() . "/uploads/podcasts/" . $podcast->audio_file;
        $link2 = public_path() . "/uploads/podcasts/" . $podcast->thumbnail;
        if (file_exists($link1)) {
            unlink($link1);
        }
        if (file_exists($link2)) {
            unlink($link2);
        }
        Podcast::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Podcast Deleted Successfully.');
    }
}
