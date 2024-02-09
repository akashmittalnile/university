<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        try {
            $count = Blog::count();
            $blog = Blog::when($request->has('search'), function ($query) {
                $search = request('search');
                return $query->where('title', 'LIKE', "%$search%");
            })->orderByDesc('id')->paginate(config("app.ebook_per_page"));
            return view('admin.blog.index')->with(compact('blog', 'count'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('admin.blog.create');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'thumbnail' => 'required',
                'link' => 'required',
                'description' => 'required',
                'cancellation_policy' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            } else {
                $blog = new Blog;

                $uid = uniqid();
                if ($request->hasFile("thumbnail")) {
                    $file = $request->file('thumbnail');
                    $name = "blog_" .  $uid . "." . $file->getClientOriginalExtension();
                    $blog->image = $name;
                    $file->move("uploads/blogs", $name);
                }

                $blog->title = $request->name;
                $blog->description = $request->description;
                $blog->links = $request->link;
                $blog->policy = $request->cancellation_policy;
                $blog->status = 1;
                $blog->save();

                $array_of_image = json_decode($request->array_of_image);
                if (is_array($array_of_image) && count($array_of_image) > 0) {
                    foreach ($array_of_image as $val) {
                        BlogAttribute::where('image', $val)->where('type', 'slide_image')->update([
                            'blog_id' => $blog->id,
                        ]);
                    }
                }
                return redirect()->route('admin.blog')->with('success', 'Blog Created Successfully.');
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $id = encrypt_decrypt('decrypt', $id);
            $blog = Blog::where('id', $id)->first();
            $img = BlogAttribute::where('blog_id', $id)->where('type', 'slide_image')->get();
            return view('admin.blog.edit')->with(compact('blog', 'img'));
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'link' => 'required',
                'cancellation_policy' => 'required',
            ]);

            if ($validator->fails()) {
                return errorMsg($validator->errors()->first());
            } else {
                $id = encrypt_decrypt('decrypt', $id);
                $blog = Blog::where('id', $id)->first();
                $uid = uniqid();
                if ($request->hasFile("thumbnail")) {
                    $file = $request->file('thumbnail');
                    $name = "blog_" .  $uid . "." . $file->getClientOriginalExtension();
                    $link = public_path() . "/uploads/blogs/" . $blog->image;
                    if (File::exists($link)) {
                        unlink($link);
                    }
                    $blog->image = $name;
                    $file->move("uploads/blogs", $name);
                }

                $blog->title = $request->name;
                $blog->links = $request->link;
                $blog->description = $request->description;
                $blog->policy = $request->cancellation_policy;
                $blog->status = 1;
                $blog->updated_at = date('Y-m-d H:i:s');
                $blog->save();

                $array_of_image = json_decode($request->array_of_image);
                if (is_array($array_of_image) && count($array_of_image) > 0) {
                    foreach ($array_of_image as $val) {
                        BlogAttribute::where('image', $val)->where('type', 'slide_image')->update([
                            'blog_id' => $blog->id,
                        ]);
                    }
                }
                return redirect()->route('admin.blog')->with('success', 'Blog Updated Successfully.');
            }
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $id = encrypt_decrypt('decrypt', $id);
            $blog = Blog::where('id', $id)->first();
            $img = BlogAttribute::where('blog_id', $id)->where('type', 'slide_image')->get();
            foreach ($img as $val) {
                $link = public_path() . "/uploads/blogs/" . $val->image;
                if (File::exists($link)) {
                    unlink($link);
                }
            }
            $link = public_path() . "/uploads/blogs/" . $blog->image;
            if (File::exists($link)) {
                unlink($link);
            }
            BlogAttribute::where('blog_id', $id)->where('type', 'slide_image')->delete();
            Blog::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Blog Deleted Successfully.');
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function imageUpload(Request $request)
    {
        try {
            $uid = uniqid();
            $file = $request->file('file');
            $name = "blog_" .  $uid . "." . $file->getClientOriginalExtension();
            $blog_id = isset($request->id) ? encrypt_decrypt('decrypt', $request->id) : null;
            $blog = BlogAttribute::create([
                'blog_id' => $blog_id,
                'type' => 'slide_image',
                'status' => 1,
                'image' => $name,
            ]);
            $file->move("uploads/blogs", $name);
            return response()->json(['status' => true, 'file_name' => $name, 'key' => 1]);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function imageDelete(Request $request)
    {
        try {
            $filename =  $request->get('filename');
            $blog = BlogAttribute::where('image', $filename);
            if ($blog->delete()) {
                $link = public_path() . "/uploads/blogs/" . $filename;
                if (File::exists($link)) {
                    unlink($link);
                }
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
            $attr = BlogAttribute::where('id', $id)->first();
            $count = BlogAttribute::where('blog_id', $attr->blog_id)->count();
            if ($count == 1) return redirect()->back()->with('error', "Minimum one blog image must be required. Can't Remove");
            $link = public_path() . "/uploads/blogs/" . $attr->image;
            if (file_exists($link)) {
                unlink($link);
            }
            BlogAttribute::where('id', $id)->delete();
            return redirect()->back()->with('idredirect',  1);
        } catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
