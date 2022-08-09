<?php

   

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\cart;
use App\Models\order_details;
use Illuminate\Support\Facades\Mail;
use App\Mail\noticemail;
use Carbon\carbon;
use App\Models\product;
use App\Models\inventory;
   

class StripePaymentController extends Controller

{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('frontend.stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        
        // Stripe::setApiKey(('sk_test_51LL0ICGGLaCzf67K1Fo5s8ja1ygD9oUWpMxpTZTlbGJasBx2aNFLZqy4X6Zz0JhloFN2mFA8C55WfbvClxDC6tVt005hIbx1AI'));
        Stripe::setApiKey((config('services.stripe.secret_key')));
        Charge::create ([

                "amount" => $request->payment * 100,

                "currency" => "bdt",

                "source" => $request->stripeToken,

                "description" => "Test payment from jaheen developer" 

        ]);

        $ordered = session('data');
        $order_number = uniqid();
        foreach(cart::where('user_id',Auth::guard('logan')->id())->get() as $cr){
            order_details::insert([
                 'user_name'=>$ordered['fname'],
                 'product_id'=>$cr->product_id,
                 'size'=>$cr->size,
                 'color' => $cr->color,
                 'quantity' => $cr->quantity,
                 'total_price' => $cr->total_price,
                 'Email' => $ordered['email'],
                 'phone' => $ordered['phone'],
                 'country' => $ordered['country'],
                 'city' => $ordered['city'],
                 'address' => $ordered['address'],
                 'notes' => $ordered['comment'],  
                 'payment_method' => $ordered['payment_method'],
                 'order_number' => $order_number,
                 'grand_total' => $ordered['grand_total'],
                 'created_at' => carbon::now(),
                 
            ]);
            product::where('id',$cr->product_id)->decrement('quantity',$cr->quantity);
        
            $quantity = intval(inventory::where('product_id',$cr->product_id)->where('color',$cr->color)->where('size',$cr->size)->first()->quantity) - intval($cr->quantity);

            inventory::where('product_id',$cr->product_id)->where('color',$cr->color)->where('size',$cr->size)->update([
                'quantity' => $quantity,
            ]);
            $all_data = $ordered;
            $id = $cr->all();
            Mail::to($ordered['email'])->send(new noticemail($all_data,$id,$order_number));
            cart::find($cr->id)->delete();
            }

        return view('frontend.done',[
            'order_number' => $order_number,
        ]);

    }

}