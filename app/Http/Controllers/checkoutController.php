<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use Carbon\carbon;
use Auth;
use App\Models\order_details;
use App\Models\product;
use Illuminate\Support\Facades\Mail;
use App\Mail\noticemail;
use App\Models\country;
use App\Models\city;
use App\Models\inventory;

class checkoutController extends Controller
{
    function index(Request $request){
        $total = $request->total;
        $discount = $request->discount;
        $country = country::all();

        return view('frontend.checkout',[
            'total' => $total,
            'discount' => $discount,
            'country' => $country,
        ]);
        
    }

    function payment(Request $request){
        
        if($request->payment_method == 1){
        $order_number = uniqid();
        foreach(cart::where('user_id',Auth::guard('logan')->id())->get() as $cr){
        order_details::insert([
             'user_name'=>$request->fname,
             'product_id'=>$cr->product_id,
             'size'=>$cr->size,
             'color' => $cr->color,
             'quantity' => $cr->quantity,
             'total_price' => $cr->total_price,
             'Email' => $request->email,
             'phone' => $request->phone,
             'country' => $request->country,
             'city' => $request->city,
             'address' => $request->address,
             'notes' => $request->comment,  
             'payment_method' => $request->payment_method,
             'order_number' => $order_number,
             'grand_total' => $request->grand_total,
             'estimated_time' =>carbon::now()->addDays(7),
             'created_at' => carbon::now(),  
        ]);
        product::where('id',$cr->product_id)->decrement('quantity',$cr->quantity);
        
        $quantity = intval(inventory::where('product_id',$cr->product_id)->where('color',$cr->color)->where('size',$cr->size)->first()->quantity) - intval($cr->quantity);

        inventory::where('product_id',$cr->product_id)->where('color',$cr->color)->where('size',$cr->size)->update([
            'quantity' => $quantity,
        ]);

        product::where('id',$cr->product_id)->increment('total_sold',$cr->quantity);
        $all_data = $request->all();
        $id = $cr->all();
        
        Mail::to($request->email)->send(new noticemail($all_data,$id,$order_number));
        cart::find($cr->id)->delete();
        } 
      }
    

      else if($request->payment_method == 2){
            $data = $request->all();
            return view('frontend.stripe',[
                'payment' => $request->grand_total,
                'data' => $data, 
            ]);    
        }

    return view('frontend.done',[
            'order_number' => $order_number,
        ]);
    }

    function getcity($country_id){
        $cities = city::where('country_id',$country_id)->get();
       
        $str = '<option>Select a city</option>';
        foreach($cities as $city){
            $str .='<option value ="'.$city->id.'">'.$city->name.'</option>';
        }
        echo $str;
    }
}
 