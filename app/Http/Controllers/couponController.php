<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\coupon;
use Carbon\carbon;
use Auth;
use App\Models\cart;

class couponController extends Controller
{
    function coupon(){
        $coupons = coupon::all();
        return view('admin_side.coupon.index',[
            'coupons' => $coupons,
        ]);
    }


    function coupon_insert(Request $request){
        coupon::insert([
            'coupon_name' => $request->coupon_name,
            'validation' => $request->validation,
            'discount' => $request->discount,
            'created_at' => carbon::now(),
        ]);
        return back()->with('success','coupon added successfullly');
    }



    function apply_coupon(Request $request){
        $coupon = $request->coupon_code;
        $message = null;
        if($coupon=='')
        {
            $discount = 0;
            
        }
        else
        {
            if(coupon::where('coupon_name',$coupon)->exists()){
                if(Carbon::now()->format('Y-m-d') < coupon::where('coupon_name',$coupon)->first()->validity){
                    $message = "coupon is expired";
                    $discount = 0;
                }
                else{
                    $discount = coupon::where('coupon_name',$coupon)->first()->discount;
                }    
            }
            else{
                    $message = 'Invalid coupon entered';
                    $discount = 0;
            }
        }
        $cart = cart::where('user_id',Auth::guard('logan')->id())->get();
        return view('frontend.cart',[
            'carts' => $cart,
            'discount' => $discount,
            'message' => $message,
        ]);
    }
}
