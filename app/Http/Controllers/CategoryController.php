<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //category_index
    public function category_index(){
        $data = array();
        $data['active_menu'] = 'add_category';
        $data['page_title'] = 'Add Category';
        $category = Category::all();
        if(request()->isMethod('post')){
            $category = new Category();
            $category->category_name = request()->category_name;
            $category->details = request()->details;
            $category->save();
            return back()->with('message','Category Successfully Added');
        }
        return view('backend.category.listCategory',compact('category','data'));
    }
    public function category_delete($id){
        Category::find($id)->delete();
        return back()->with('message','Category Successfully Deleted');
    }
    //expencelist
    public function expencelist()
    {
        $data = array();
        $data['active_menu'] = 'add_category';
        $data['page_title'] = 'Add Category';
    }
}
