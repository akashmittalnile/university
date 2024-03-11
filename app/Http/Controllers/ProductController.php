<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try{
            $count = Product::count();
            $product = Product::when($request->has('search'), function($query){
                $search = request('search');
                return $query->where('title', 'LIKE', "%$search%");
            })->orderByDesc('id')->paginate(config("app.ebook_per_page"));
            return view('admin.product.index')->with(compact('product', 'count'));
        }  catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function create()
    {
        try{
            return view('admin.product.create');
        }  catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'price' => 'required',
                'thumbnail' => 'required',
                'description' => 'required',
                'cancellation_policy' => 'required',
            ]);

            if ($validator->fails()) {
                return errorMsg($validator->errors()->first());
            }else{
                $product = new Product;

                if ($request->hasFile("thumbnail")) {
                    $name = fileUpload($request->thumbnail, "uploads/products");
                    $product->image = $name;
                }

                $product->title = $request->name;
                $product->description = $request->description;
                $product->policy = $request->cancellation_policy;
                $product->price = $request->price;
                $product->status = 1;
                $product->save();

                $array_of_image = json_decode($request->array_of_image);
                if(is_array($array_of_image) && count($array_of_image)>0){
                    foreach($array_of_image as $val){
                        ProductAttribute::where('image', $val)->where('type', 'slide_image')->update([
                            'product_id' => $product->id,
                        ]);
                    }
                }

                return successMsg('Product Created Successfully.');
            }
        }  catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $id = encrypt_decrypt('decrypt', $id);
            $product = Product::where('id', $id)->first();
            $img = ProductAttribute::where('product_id', $id)->where('type', 'slide_image')->get();
            return view('admin.product.edit')->with(compact('product', 'img'));
        }  catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'cancellation_policy' => 'required',
            ]);

            if ($validator->fails()) {
                return errorMsg($validator->errors()->first());
            }else{
                $id = encrypt_decrypt('decrypt', $id);
                $product = Product::where('id', $id)->first();
                
                if ($request->hasFile("thumbnail")) {
                    $link = public_path() . "/uploads/products/" . $product->image;
                    if(File::exists($link)) {
                        unlink($link);
                    }
                    $name = fileUpload($request->thumbnail, "uploads/products");
                    $product->image = $name;
                }
    
                $product->title = $request->name;
                $product->description = $request->description;
                $product->policy = $request->cancellation_policy;
                $product->price = $request->price;
                $product->status = 1;
                $product->updated_at = date('Y-m-d H:i:s');
                $product->save();
    
                $array_of_image = json_decode($request->array_of_image);
                if(is_array($array_of_image) && count($array_of_image)>0){
                    foreach($array_of_image as $val){
                        ProductAttribute::where('image', $val)->where('type', 'slide_image')->update([
                            'product_id' => $product->id,
                        ]);
                    }
                }
                return successMsg('Product Updated Successfully.');
            }
        }  catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $id = encrypt_decrypt('decrypt', $id);
            $product = Product::where('id', $id)->first();
            $img = ProductAttribute::where('product_id', $id)->where('type', 'slide_image')->get();
            foreach($img as $val){
                $link = public_path() . "/uploads/products/" . $val->image;
                if(File::exists($link)) {
                    unlink($link);
                }
            }
            $link = public_path() . "/uploads/products/" . $product->image;
            if(File::exists($link)) {
                unlink($link);
            }
            ProductAttribute::where('product_id', $id)->where('type', 'slide_image')->delete();
            Product::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Product Deleted Successfully.');
        }  catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function imageUpload(Request $request)
    {
        try{
            $pro_id = isset($request->id) ? encrypt_decrypt('decrypt', $request->id) : null;
            $name = fileUpload($request->file, "uploads/products");
            $product = ProductAttribute::create([
                'product_id' => $pro_id,
                'type' => 'slide_image',
                'status' => 1,
                'image' => $name,
            ]);
            return response()->json(['status'=>true, 'file_name'=> $name, 'key'=> 1]); 
        }  catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function imageDelete(Request $request)
    {
        try{
            $filename =  $request->get('filename');
            $pro = ProductAttribute::where('image',$filename);
            if($pro->delete()){
                $link = public_path() . "/uploads/products/" . $filename;
                if(File::exists($link)) {
                    unlink($link);
                }
                return response()->json(['status'=>true, 'file_name'=> $filename, 'key'=> 2]);   
            }
            return response()->json(['status'=>false, 'file_name'=> $filename, 'key'=> 2]);
        }  catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }

    public function uploadedImageDelete($id)
    {
        try{
            $id = encrypt_decrypt('decrypt', $id);
            $attr = ProductAttribute::where('id', $id)->first();
            $count = ProductAttribute::where('product_id', $attr->product_id)->count();
            if($count == 1) return redirect()->back()->with('error', "Minimum one product image must be required. Can't Remove");
            $link = public_path() . "/uploads/products/" . $attr->image;
            if(file_exists($link)) {
                unlink($link);
            }
            ProductAttribute::where('id', $id)->delete();
            return redirect()->back()->with('idredirect',  1);
        }  catch (\Exception $e) {
            return errorMsg('Exception => ' . $e->getMessage());
        }
    }
}
