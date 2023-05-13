<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Support\Str;
use App\Models\ProductAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Product::with('assets')->get();
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ], 400);
        } else {
            // create Slug
            $slug = Str::slug($request->name);

            // create Product
            $new_product = new Product();
            $new_product->name = $request->name;
            $new_product->slug = $slug;
            $new_product->price = $request->price;
            $category = Categorie::find($request->category_id);
            $category->products()->save($new_product);

            // Create Image Asset
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = $image->getClientOriginalName();
                    $destinationPath = 'images/';
                    $image->move($destinationPath, $imageName);
                    $productAsset = new ProductAsset();
                    $productAsset->image = $imageName;
                    $product = Product::find($new_product->id);
                    $product->assets()->save($productAsset);
                }
            }

            return response()->json([
                'status' => true,
                'msg' => 'Data Berhasil Di Tambahkan',
                'data' => $new_product
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ], 400);
        } else {
            // Create Slug
            $slug = Str::slug($request->name);

            // create Product
            $product->name = $request->name;
            $product->slug = $slug;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->save();
            return response()->json([
                'status' => true,
                'msg' => 'Data Berhasil Di Ubah',
                'data' => $product
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->assets()->delete();
        $product->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Data Berhasil Di Hapus',
        ], 200);
    }

    public function sortByPrice()
    {
        $products_sort_price = Product::orderBy('price', 'desc')->get();
        return response()->json([
            'status' => true,
            'data' => $products_sort_price
        ], 200);
    }
}
