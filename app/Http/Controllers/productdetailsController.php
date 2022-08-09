<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\productThumbnail;
use App\Models\cart;
use App\Models\inventory;
use App\Models\review;
use Auth;


class productdetailsController extends Controller
{
    function index($pro_id){
        
        $pro=$pro_id;
        $cart = cart::all();
        $product = product::where('id',$pro)->get()->first();
        $color = product::where('id',$pro)->get()->first()->color;
        $col = explode("/",$color);
        $size = product::where('id',$pro)->get()->first()->size;
        $siz = explode("/",$size);
        $inventory = inventory::all();
        $thumbnail = productThumbnail::all();


        /*this tis to check if a user is loged in or not in controller*/
        // Auth::guard('logan')->check()      

        $review_count = review::where('product_id',$pro)->count();
        if(intval($review_count) == 0){
            $avarage = "(Give review to rate the product)";
        }
        else{
            $stars = 0;
            for($i=0;$i<$review_count;$i++){
                $stars += review::where('product_id',$pro)->first()->stars;
            }
            $avarage =$stars/$review_count;  
        }
        

        return view('frontend.product_details',[
            'cart' => $cart,
            'product' => $product,
            'thumbnail' => $thumbnail,
            'jk_id' => $pro,
            'color' => $col,
            'size' => $siz,
            'inventory' => $inventory,
            'star' => $avarage,
            
        ]);
            
        
        
        
    }

    function getsize(Request $request){
       $detail =  inventory::where('product_id',$request->khan)->where('color',$request->jaheen)->get();

       $str_to_send = '';
        $str_to_send2 = '';

       foreach($detail as $dt){

        if($dt->quantity == 0)
        {
            
        }
        else{
            $str_to_send .= '<li data-value="'.$dt->size.'" value="'.$dt->size.'" class="option">'.$dt->size.'</li>';
            $str_to_send2 .= '<option value="'.$dt->size.'" class="option">'.$dt->size.'</option>';  
        }
        
       }

       $data = array('nice'=>$str_to_send,'select'=>$str_to_send2);
       
       return $data;
    }


    function getstock(Request $request){
        $details = inventory::where('product_id',$request->idd)->where('color',$request->clr)->where('size',$request->siz)->get()->first()->quantity;
        $size = $request->siz;
        
        $data = array("detail" => $details,"size"=>$size);
        return $data;
    }
}

