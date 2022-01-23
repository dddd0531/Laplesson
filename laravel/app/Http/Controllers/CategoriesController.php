<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{
	public function index(){
		//$categories = Category::latest('created_at')->get();
		$categories = Category::oldest('number')->get();
		return view('admin.category',['categories' => $categories]);	
	}

	public function create(){
		return view('admin.categorycreate');	
	}

	public function edit($id){
		$category = Category::findOrFail($id);
		return view('admin.categoryedit',['category' => $category]);	
	}

	public function destroy($id){
		$category = Category::findOrFail($id);
		$category->delete();
		return redirect('/admin/category')->with('flash_message', 'Category Deleted!');
	}

	public function store(CategoryRequest $request) {
		$category = new Category();
		$category->number = $request->number;
		$category->category = $request->category;
		$category->description = $request->description;
		$category->released = $request->released;
		$category->save();
		return redirect('/admin/category')->with('flash_message', 'Category Added!');
	}

	public function update(CategoryRequest $request, $id) {
		$category = Category::findOrFail($id);
		$category->number = $request->number;
		$category->category = $request->category;
		$category->description = $request->description;
		$category->released = $request->released;
		$category->save();
		return redirect('/admin/category')->with('flash_message', 'Category Updated!');
	}


}
