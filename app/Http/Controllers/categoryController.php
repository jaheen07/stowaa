<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Carbon\carbon;
use Auth;
use Intervention\Image\Facades\Image;

class categoryController extends Controller
{
    function category(){
        $category = category::all();
        return view('admin_side.category.index',[
            'categories'=>$category,
        ]);
    }


    function insert(Request $request){
        if(category::where('category_name',$request->category_name)->exists()){
            
            return back()->with('success',"category already exists");
        }
        
        else{
           $id = category::insertGetId([
            'category_name'=>$request->category_name,
            'icons' =>$request->icons,
            'added_by'=>Auth::id(),
            'created_at'=>Carbon::now(),
            ]);

            $category_img = $request->category_image;
            $ext = $category_img->getClientOriginalExtension();
            $new_image_name = $id.'.'.$ext;

            Image::make($category_img)->resize(200,256)->save(public_path('/uploads/category/').$new_image_name);

            category::find($id)->update([
                'category_image'=>$new_image_name,
            ]);

            return back()->with('success',"category added successfully"); 
        }
        
    }
}

