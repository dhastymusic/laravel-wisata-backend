<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //index method
    public function index(Request $request)
    {
        $products = Product::when($request->keyword, function ($query) use ($request) {
            $query->where('name', 'LIKE', "%{$request->keyword}%")
                ->orWhere('description', 'LIKE', "%{$request->keyword}%")
                ->orWhere('price', 'LIKE', "%{$request->keyword}%")
                ->orWhere('stock', 'LIKE', "%{$request->keyword}%")
                ->orWhere('category_id', 'LIKE', "%{$request->keyword}%")
                ->orWhere('status', 'LIKE', "%{$request->keyword}%")
                ->orWhere('criteria', 'LIKE', "%{$request->keyword}%")
                ->orWhere('favorite', 'LIKE', "%{$request->keyword}%");
        })->orderBy('id','desc')->paginate(10);
        return view('pages.products.index', compact('products'));
    }

    //create method
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('pages.products.create', compact('categories'));
    }
    //store method
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            //image
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.' . $image->extension());
            $product->image ='products/'. $product->id . '.' . $image->extension();
            $product->save();


        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }
    //edit method
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('pages.products.edit', compact('categories', 'product'));
    }

    //update method
    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'stock' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category_id' => 'required',
        'status' => 'required',
        'criteria' => 'required',
        'favorite' => 'required',
    ]);

    // Update produk dengan data baru
    $product->category_id = $request->category_id;
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->criteria = $request->criteria;
    $product->favorite = $request->favorite;
    $product->status = $request->status;
    $product->stock = $request->stock;

    //check if image is not empty
    if ($request->image) {
        $image = $request->file('image');
        $image->storeAs('public/products', $product->id . '.' . $image->extension());
        $product->image = 'products/' . $product->id . '.' . $image->extension();
        $product->save();
    }



    return redirect()->route('products.index')->with('success', 'Product updated successfully');
}
    //destroy method
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }


}
