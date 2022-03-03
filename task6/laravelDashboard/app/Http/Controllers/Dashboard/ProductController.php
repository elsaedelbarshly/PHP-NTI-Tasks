<?php

namespace App\Http\Controllers\Dashboard;

use App\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->select('id', 'name_en', 'code', 'price', 'status', 'quantity', 'created_at')->get();
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $brands = DB::table('brands')->select('name_en', 'id')->get();
        $subcategories = DB::table('sub_categories')->select('name_en', 'id')->get();
        return view('dashboard.products.create', compact('brands', 'subcategories'));
    }

    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first(); 
        $brands = DB::table('brands')->select('name_en', 'id')->get();
        $subcategories = DB::table('sub_categories')->select('name_en', 'id')->get();
        return view('dashboard.products.edit', compact('product', 'brands', 'subcategories'));
    }


    public function store(StoreProductRequest $request)
    {
        $photoName = Media::upload($request->file('image'),'products');
        $data = $request->safe()->except(['_token', 'image', 'submit']);
        $data['image'] = $photoName;
        DB::table('products')->insert($data);
        return returnRedirectAccordingToBtn($request);
    }

    public function update(UpdateProductRequest $request, $id)
    {

        $product = DB::table('products')->where('id', $id)->first();
        $data = $request->except('_token', '_method', 'submit', 'image');
        if ($request->has('image')) 
        {
            $newPhotoName = Media::upload($request->file('image'),'products');
            Media::delete("images/products/{$product->image}");

            $data['image'] = $newPhotoName;
        }
        DB::table('products')->where('id', $id)->update($data);
        return redirect()->route('dashboard.products.index')->with('success', 'Operation Successfull');
    }

    public function destroy($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        Media::delete("images/products/{$product->image}");
        DB::table('products')->where('id',$id)->delete();
        return redirect()->back()->with('success', 'Operation Successfull');
    }

    public function statusToggle(Request $request,$id)
    {
        $status = $request->has('my-checkbox') ? 1 : 0;
        DB::table('products')->where('id',$id)->update(['status'=>$status]);
        return redirect()->back()->with('success', 'Operation Successfull');
    }
}
