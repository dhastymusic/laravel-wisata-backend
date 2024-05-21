<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    //get all categories
    public function index(Request $request)
    {
        $categories = Category::when($request->keyword, function($query) use($request){
            $query->where('name', 'like', '%'.$request->keyword.'%')
            ->orWhere('description', 'like', '%'.$request->keyword.'%');
        })->orderBy('name','ASC')
        ->get();

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ], 200);
    }
    //store category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return response()->json([
            'status' => 'success',
            'data' => $category
        ], 200);
    }
    //show category
    public function show($id)
    {
        $category = Category::find($id);

        if($category){
            return response()->json([
                'status' => 'success',
                'data' => $category
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }
    }
    //update category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = Category::find($id);
        if($category){
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();

            return response()->json([
                'status' => 'success',
                'data' => $category
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }
    }
    //delete category
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted'
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }
    }

}

