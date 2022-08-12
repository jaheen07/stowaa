<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subcategory;
use App\Models\product;
use App\Models\category;
use App\Models\order_details;
use App\Models\records;
use App\Models\CustomerLogin;
use Illuminate\Support\Facades\Mail;
use App\Mail\feedbackmail;
use App\Models\newsletter_emails;
use Carbon\carbon;
use App\Models\wishlist;
use App\Models\inventory;
use Auth;


class frontendController extends Controller
{
    function index(){
        if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pwd'])){
            $login_email = $_COOKIE['login_email'];
            $login_pwd = $_COOKIE['login_pwd'];
            if(Auth::guard('logan')->attempt(['email'=>$login_email, 'password'=> $login_pwd])){
                return view('frontend.index');
            }
        }
        else{
            return view('frontend.index');
        }
        
    }

    
    function about_us(){
        return view('frontend.about');
    }

    function contact_us(){
        $locations = [

            ['illiyeen1', 23.811068354565606, 90.35596561799872],

            ['illiyeen2', 23.87889615041927, 90.3889246034473],

            ['illiyeen3 ', 23.8223754512007, 90.42325687995621],

            ['illiyeen4', 23.79552411248887, 90.40165194495327],

            ['illiyeen5', 23.74713796874829, 90.40886172302017],

            ['illiyeen6', 23.761592857612964, 90.37281283268578],

        ];
        return view('frontend.contact',[
            'locations' => $locations,
        ]);
    }

    function feedback(Request $request){
        $all_data = $request->all();
        
        Mail::to('jaheen027@gmail.com')->send(new feedbackmail($all_data));
        return back()->with('success','We got your mail.Thank you for you feedback.');
    }

    function shop(Request $request){

        
        $products = product::simplePaginate(12);
       
        return view('frontend.shop',[
            'product' =>$products,
            
        ]);
        
    }

    function categorywise_shop($category_id,$subcategory_id){
        $cat_id = $category_id;
        $sub_id = $subcategory_id;
        $subcategory = subcategory::all();
        $product = product::where('category_name',category::where('id',$cat_id)->get()->first()->category_name)->simplePaginate(12);
       
        
        return view('frontend.categorywise_shop',[
            'jk_id' => $cat_id,
            'jk_sub_id' => $sub_id,
            'product' => $product,
            'subcategories' => $subcategory,

        ]);
        
    }

    function wishlist(){
        $wishlist = wishlist::all();
        return view('frontend.wishlist',[
            'wishlist' => $wishlist,
        ]);
    }

    function wishlist_insert(Request $request){
        if(wishlist::where('product_id',$request->jaheen)->where('user_id',Auth::guard('logan')->user()->id)->exists()){
            echo 'product is already in your wishlist.';
        }
        else{
            wishlist::insert([
                'product_id' => $request->jaheen,
                'user_id' => Auth::guard('logan')->user()->id,
            ]);
            echo 'product added to wishlist successfully';
        }

        
    }
    function account(Request $request){
        $order_type= $request->order_type;
        return view('frontend.account',[
            'order_type' => $order_type,
        ]);
    }

   

    function search(Request $request){
        $category = $request->search_cat;
        $search = strtolower($request->search);
        $product = product::where('category_name',$category)->get();
        foreach(category::all() as $ct){
            if($ct->category_name == $category){
                $cat = $ct->id;
            }
        }
        // echo $cat;
        if($category == "all"){
            $product = product::all();
            $count =0;
            foreach($product as $pro)
            {
                if(strtolower($pro->product_name) == $search){
                    return redirect('/product_details/'.$pro->id);
                }
                elseif(strrpos($search,strtolower($pro->subcategory_name))> -1)
                {
                    $cat = category::where('category_name',$pro->category_name)->first()->id;
                    //To show all matched sub category products
                    return redirect('/selected_subcategory/'.$cat.'/'.$pro->subcategory_name);
                }
                $count+=1;
            }
            if($count > 0){
                return redirect('/shop');
            }
        }
        else{
            $count=0;
            foreach($product as $pro){
                if(strtolower($pro->product_name) == $search)
                {
                    //To show direct matched product;
                return redirect('/product_details/'.$pro->id);
                }
                elseif(strrpos($search,strtolower($pro->subcategory_name))> -1)
                {
                    //To show all matched sub category products
                    return redirect('/selected_subcategory/'.$cat.'/'.$pro->subcategory_name);
                }
                $count+=1;
            }   
                if($count > 0)
                {
                    //To show all category wise products
                    return redirect('/categorywise_shop/'.$cat.'/'.'sub');
                }
            
        }
    }

    function track_order_index(Request $request){
        if($request->track_id){
          return redirect('/tracking/'.$request->track_id);  
        }
        else{
            return view('frontend.track_order');
        }
    }


    function tracking_index($order_id){
        
        if(order_details::where('order_number',$order_id)->exists()){
            $order_detail = order_details::where('order_number',$order_id);
            $stat = 0;
        }
        else{
            $order_detail = records::where('order_number',$order_id);
            $stat = 1;
        }
        $pro = product::where('id',$order_detail->get()->first()->product_id)->get();
        
        return view('frontend.tracking',[
            'order_detail' => $order_detail,
            'pro' => $pro,
            'stat' => $stat,
        ]);
    }
    

    function log_reg(Request $request){
        $get_url = $request->get_url;
        
        return view('frontend.log_reg',[
        'get_url' => $get_url,
        ]);  
        
        
    }

    function info_update(Request $request){
        CustomerLogin::where('id',$request->info_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return back()->with('success','updated successfully!');
    }

    function newsletter(Request $request){
        newsletter_emails::insert([
            'emails' => $request->email,
            'created_at' => carbon::now(),
        ]);
        return back()->with('success2','Thank you for entering ');
    }

    function inventory($id){
        // $inventory = inventory::where('product_id',$id)->get();
        $color = product::where('id',$id)->get()->first()->color;
        $col = explode("/",$color);
        $size = product::where('id',$id)->get()->first()->size;
        $siz = explode("/",$size);
        $pro = product::where('id',$id);
        
        return view('admin_side.inventory.inventory',[
            'jk_id' => $id,
            'color' => $col,
            'size' => $siz,
            'pro' => $pro,
            
        ]);
    }

    function inventory_insert(Request $request){

        
        if(isset($request->size)){
        $sz = strtoupper($request->size);
        }
        else{
        $sz=$request->size;
        }
        
        if(inventory::where('product_id',$request->id)->where('color',$request->color)->where('size',$request->size)->exists()){
            $qntity1 = inventory::where('product_id',$request->id)->where('color',$request->color)->where('size',$request->size)->get()->first()->quantity;
            inventory::where('product_id',$request->id)->where('color',$request->color)->where('size',$request->size)->update([
                'quantity' => $qntity1 + $request->quantity, 
            ]);
        }
        else{
        inventory::insert([
            'product_id' => $request->id,
            'color' => $request->color,
            'size' => $sz,
            'quantity' => $request->quantity,
            'created_at' => carbon::now(),
        ]);
        }

        $size=product::where('id',$request->id)->first()->size;
        if($size == NULL){
          $size = $sz;  
        }
        else{
            $count=0;
            $size2 = product::where('id',$request->id)->get()->first()->size;
            $siz = explode("/",$size2);
            for($i=0;$i<sizeof($siz);$i++){
                if(strtolower($siz[$i])==strtolower($request->size)){
                    $count+=1;
                    break;
                }
            }
            if($count == 0){
                $size = $size.'/'.$sz;
            }
            else{
                $size = $size;
            }
            
        }
        $quantity = product::where('id',$request->id)->get()->first()->quantity + $request->quantity;
            product::where('id',$request->id)->update([
                'size' => $size,
                'quantity' => $quantity,
            ]); 
        return back();
    }

    function records(){
       $records = records::all();
       return view('admin_side.records.records',[
        'records' => $records,
       ]);
    }
}
