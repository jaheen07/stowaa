<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banner;
use App\Models\product;
use Carbon\carbon;
use Intervention\Image\Facades\Image;


class bannerController extends Controller
{
    function banner(){
        $banner = banner::all();
        return view('admin_side.banner.banner',[
            'banner' => $banner,
        ]);
        
    } 


    function getproduct(Request $request){
        if($request->jaheen == 0){
            $str_to_send = '<option value="none">None</option>';
            echo $str_to_send;
        }
        else if($request->jaheen != 0){
            $products = product::all(); 
            $str_to_send='<option value="">--select product--</option>';

            foreach($products as $pro){
                $str_to_send .='<option value="'.$pro->id.'">'.$pro->product_name.'</option>';
            }

            echo $str_to_send;
        }
    }

    function banner_insert(Request $request){
        $id = banner::insertGetId([
            
            'banner_number' => $request->banner_number,
            'product_id' => $request->product,
            'created_at' => carbon::now(),
        ]);
        
        $bn_image = $request->banner_image;
        $ext = $bn_image->getClientOriginalExtension();
        $final_image = $request->banner_number.'-'.$id.'.'.$ext;

        if($request->banner_number == 0 || $request->banner_number = 1){
           Image::make($bn_image)->resize(844,517)->save(public_path('uploads/banner/').$final_image); 
        }
        else if($request->banner_number == 4 || $request->banner_number = 5){
            Image::make($bn_image)->resize(714,297)->save(public_path('uploads/banner/').$final_image); 
         }
         else if($request->banner_number == 6){
            Image::make($bn_image)->resize(488,784)->save(public_path('uploads/banner/').$final_image); 
         }

        banner::find($id)->update([
            'banner_image' =>$final_image,
        ]);

        return back()->with('success','banner placed successfully');
    }
}
