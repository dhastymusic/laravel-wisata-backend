<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    //index product
    public function index(Request $request)
    {
        $products = Product::with('category')->when($request->keyword, function($query) use($request){
            $query->where('name', 'like', '%'.$request->keyword.'%')
            ->orWhere('description', 'like', '%'.$request->keyword.'%');
        })->orderBy('favorite','desc')
        ->get();

        return response()->json([
            'status' => 'success',
            'data' => $products
        ], 200);

    }
    //store product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'criteria' => 'required',
            'favorite' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->criteria = $request->criteria;
        $product->favorite = $request->favorite;
        $product->save();
        //upload image
        if($request->file('image')){
            $image= $request->file('image')->storeAs('public/products',$product->id.'.'.$request->file('image')->extension());
            $product->image = $image;
            $product->save();
        }

        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }
    //show product
    public function show($id)
    {
        $product = Product::find($id);

        if($product){
            return response()->json([
                'status' => 'success',
                'data' => $product
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'product not found'
            ], 404);
        }
    }
    //update product
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'criteria' => 'required',
            'favorite' => 'required',
        ]);

        $product = Product::find($id);
        if($product){
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->category_id = $request->category_id;
            $product->status = $request->status;
            $product->criteria = $request->criteria;
            $product->favorite = $request->favorite;
            $product->save();
            //upload image
            if($request->file('image')){
                $image= $request->file('image')->storeAs('public/products',$product->id.'.'.$request->file('image')->extension());
                $product->image = $image;
                $product->save();
            }

            return response()->json([
                'status' => 'success',
                'data' => $product
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'product not found'
            ], 404);
        }
    }
    //destroy product
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'product deleted'
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'product not found'
            ], 404);
        }
    }





}
