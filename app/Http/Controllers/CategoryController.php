<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    //index
    public function index (Request $request){
        $categories = Category::when($request->keyword, function($query) use($request){
            $query->where('name', 'like', "%{$request->keyword}%")
                ->orWhere('description', 'like', "%{$request->keyword}%");
        })->orderBy('id','desc')->paginate(10);
        return view('pages.categories.index', compact('categories'));
    }

    //create
    public function create(){
        return view('pages.categories.create');
    }
    //store
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
        Category::create($request->only('name', 'description'));
        return redirect(route('categories.index'))->with(['success' => 'Category created successfully']);
    }
    //edit
    public function edit(Category $category){
        return view('pages.categories.edit', compact('category'));
    }
    //update
    public function update(Request $request, Category $category){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
        $category->update($request->only('name', 'description'));
        return redirect(route('categories.index'))->with(['success' => 'Category updated successfully']);
    }
    //destroy
    public function destroy(Category $category){
        $category->delete();
        return redirect(route('categories.index'))->with(['success' => 'Category deleted successfully']);
    }

}
