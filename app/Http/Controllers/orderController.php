<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order_details;
use App\Models\records;
use Carbon\carbon;
use Auth;

class orderController extends Controller
{
    function index(){
        return view('admin_side.orders.orders');
    }

    function package($packaging_id){
        order_details::where('id',$packaging_id)->update([
            'packaging_status' => 1,
        ]);
        return back()->with('success','packaging status has been updated');
    }

    function shipping($packaging_id){
        if(order_details::where('id',$packaging_id)->first()->packaging_status == 1)
        {
            order_details::where('id',$packaging_id)->update([
                'shipping_status' => 1,
            ]);
            return back()->with('success','shipping status has been updated');
        }
        else{
            return back()->with('error','packaging of this product is not done yet');
        }
        
    }

    function delivery($delivery_id){
        $orders = order_details::where('id',$delivery_id)->first();
        if($orders->packaging_status == 1 && $orders->shipping_status == 1){
        records::insert([
            'user_name'=>$orders->user_name,
             'product_id'=>$orders->product_id,
             'size'=>$orders->size,
             'color' => $orders->color,
             'quantity' => $orders->quantity,
             'total_price' => $orders->total_price,
             'Email' => $orders->Email,
             'phone' => $orders->phone,
             'country' => $orders->country,
             'city' => $orders->city,
             'address' => $orders->address,
             'notes' => $orders->comment,  
             'payment_method' => $orders->payment_method,
             'order_number' => $orders->order_number,
             'grand_total' => $orders->grand_total,
             'created_at' => carbon::now(),
        ]);
        $orders->delete();
        return back()->with('success','delivery status has been updated');
        }
        else{
            return back()->with('error', 'packaging and shipping should be done first');
        }
        
    }
}
