<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\subcategory;
use Carbon\carbon;
use Auth;

class subcategoryController extends Controller
{
    function subcategory(){
        $category = category::all();
        $subcategory = subcategory::all();
        
        return view('admin_side.sub_category.index',[
            'categories' => $category,
            'subcategories' => $subcategory,
        ]);
    }

    function insert(Request $request){
        if(subcategory::where('under_category',$request->category_id)->where('subcategory_name',$request->subcategory_name)->exists()){
            return back()->with("exists","subcategory already exists under this category");
        }
        else{       
        subcategory::insert([
            'under_category'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'added_by'=>Auth::id(),
            'created_at'=>Carbon::now(),
        ]);

        return back();
        }
    }
}
