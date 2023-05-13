<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAsset;
use Illuminate\Http\Request;

class ProductAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validatedData = $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $image_name = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                array_push($image_name,[
                    'image'=>$imageName
                ]);
                $destinationPath = 'images/'; 
                $image->move($destinationPath, $imageName);
                $productAsset = new ProductAsset();
                $productAsset->image = $imageName;
                $product = Product::find($request->product_id);
                $product->assets()->save($productAsset);
            }
        }
        return response()->json([
            'status'=>true,
            'msg'=>'Data Berhasil Di Tambahkan',
            'data'=>$image_name
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductAsset  $productAsset
     * @return \Illuminate\Http\Response
     */
    public function show(ProductAsset $productAsset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductAsset  $productAsset
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductAsset $productAsset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductAsset  $productAsset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductAsset $productAsset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductAsset  $productAsset
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$type)
    {
        //
        if($type == "asset"){
            ProductAsset::find($id)->delete();
        }
        else{
            Product::find($id)->assets()->delete();
        }
        return response()->json([
            'status'=>true,
            'msg'=>'Data By '.$type.' Berhasil Di Hapus'
        ], 200);
    }
}
