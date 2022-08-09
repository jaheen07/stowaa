<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\carbon;
use Auth;
use App\Models\cart;

class cartController extends Controller
{
    function index(Request $request){

        
        if(cart::where('product_id',$request->id)->where('user_id',Auth::guard('logan')->user()->id)->where('size',$request->size)->where('color',$request->color)->exists()){
            $short = cart::where('product_id',$request->id)->where('user_id',Auth::guard('logan')->user()->id)->where('size',$request->size)->where('color',$request->color);
            $quantity = intval($short->get()->first()->quantity) + intval($request->qnty);
            $total_price = intval($short->get()->first()->total_price) + intval($request->price);
            
            
            $short->update([
                'quantity' => $quantity,
                'total_price' => $total_price,
            ]);
        }
        else
        {
          cart::insert([
            'user_id'=>Auth::guard('logan')->user()->id,
            'product_id' =>$request->id,
            'color'=>$request->color,
            'size'=>$request->size,
            'quantity' =>$request->qnty,
            'total_price'=>$request->price,
            'created_at'=>Carbon::now(),
            ]);  
        }
        

        return back();
    }

    function cart_list(Request $request){
        
        $discount = 0; //to prevent interaction with after coupon process. 
        
        return view('frontend.cart',[
            'discount' => $discount,
        ]);
    }

}
