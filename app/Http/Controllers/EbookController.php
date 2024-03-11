<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use App\Models\Plan;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = Ebook::count();
        $ebooks = Ebook::when(request()->has('search'), function ($query) {
            $name = request('search');
            return $query->where("name", "LIKE", "%$name%");
        })->orderBy("id", "desc")->paginate(config("app.ebook_per_page"));
        return view('admin.ebooks.index', compact("ebooks", "count"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ebook = null;
        $plans = Plan::orderBy("price", "asc")->get();
        return view('admin.ebooks.create', compact('ebook', 'plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:podcasts,name',
                "pdf_file" => 'required|file|max:10240',
                "thumbnail" => 'required|file|max:10240',

            ]
        );
        try {
            $ebook = new Ebook();
            $ebook->name = $request->name;
            $ebook->plans = $request->plans;
            
            if ($request->hasFile("pdf_file")) {
                $file = $request->file('pdf_file');
                $sizeInBytes = $file->getSize();
                if ($sizeInBytes < 1048576) { // 1 MB = 1024 * 1024 bytes
                    $sizeInKB = round($sizeInBytes / 1024, 2);
                    $ebook->pdf_file_size = "$sizeInKB KB";
                } else {
                    $sizeInMB = round($sizeInBytes / 1048576, 2);
                    $ebook->pdf_file_size = "$sizeInMB MB";
                }
                $name = fileUpload($request->pdf_file, "uploads/ebooks");
                $ebook->pdf_file = $name;
            }

            if ($request->hasFile("thumbnail")) {
                $name = fileUpload($request->thumbnail, "uploads/ebooks");
                $ebook->thumbnail = $name;
            }
            $ebook->description = $request->description;
            $ebook->cancellation_policy = $request->cancellation_policy;
            $ebook->status = 1;
            $ebook->save();

            return response()->json([
                'message' => 'E-Book Created Successfully.',
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
    public function show(Ebook $ebook)
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
        $ebook = Ebook::where('id', $id)->first();
        $ebook->plans = $ebook->plans;
        return view('admin.ebooks.edit', compact('ebook', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $id = encrypt_decrypt('decrypt', $id);
            $ebook = Ebook::where('id', $id)->first();
            $ebook->name = $request->name;

            $ebook->plans = $request->plans;
            if ($request->hasFile("pdf_file")) {
                $file = $request->file('pdf_file');
                $sizeInBytes = $file->getSize();

                $link = public_path() . "/uploads/ebooks/" . $ebook->pdf_file;
                if (file_exists($link)) {
                    unlink($link);
                }
                $name = fileUpload($request->pdf_file, "uploads/ebooks");
                $ebook->pdf_file = $name;
                if ($sizeInBytes < 1048576) { // 1 MB = 1024 * 1024 bytes
                    $sizeInKB = round($sizeInBytes / 1024, 2);
                    $ebook->pdf_file_size = "$sizeInKB KB";
                } else {
                    $sizeInMB = round($sizeInBytes / 1048576, 2);
                    $ebook->pdf_file_size = "$sizeInMB MB";
                }
            }


            if ($request->hasFile("thumbnail")) {
                $link = public_path() . "/uploads/ebooks/" . $ebook->thumbnail;
                if (file_exists($link)) {
                    unlink($link);
                }
                $name = fileUpload($request->thumbnail, "uploads/ebooks");
                $ebook->thumbnail = $name;
            }
            $ebook->description = $request->description;
            $ebook->cancellation_policy = $request->cancellation_policy;
            $ebook->updated_at = date('Y-m-d H:i:s');
            $ebook->save();

            return response()->json([
                'message' => 'E-Book Updated Successfully.',
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
        $ebook = Ebook::where('id', $id)->first();

        $link1 = public_path() . "/uploads/ebooks/" . $ebook->pdf_file;
        $link2 = public_path() . "/uploads/ebooks/" . $ebook->thumbnail;
        if (file_exists($link1)) {
            unlink($link1);
        }
        if (file_exists($link2)) {
            unlink($link2);
        }

        Ebook::where('id', $id)->delete();
        return redirect()->back()->with('success', 'E-Book Deleted Successfully.');
    }
}
