<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\subcategory;
use App\Models\product;
use App\Models\productThumbnail;
use Intervention\Image\Facades\Image;
use Carbon\carbon;

class productController extends Controller
{
    function index(){
        $products = product::all();
        $category = category::all();
        return view('admin_side.products.index',[
            'categories' => $category,
            'products'=> $products,
        ]);
    }


    function getSubcategory(Request $request){
        $subcategories = subcategory::where('under_category',$request->jaheen)->select('id','subcategory_name')->get();
        $str_to_send ='<option>-- Select Subcategory --</option>';

        foreach($subcategories as $subcategory){
            $str_to_send .='<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';

        }
        echo $str_to_send;
    }


    function insert(Request $request)
{

    // $product_name = Str::lower($request->product_name);
   $product_id = product::insertGetId([
       'category_name'=>category::where('id',$request->category_id)->first()->category_name,
       //$request->category_id ekhane "category_id" nam ta html page theke asha ekekta input field er amr deoa variable name.
       'subcategory_name'=>subcategory::where('id',$request->subcategory_id)->first()->subcategory_name,   
       // shurute => er age je 'subcategory_id' likha ache.. sheta holo database er "products" table er jnne set kra column name.
       'product_name'=>$request->product_name,
       'product_price'=>$request->product_price,
       'discount'=>$request->discount,
       'discount_price'=>$request->product_price-($request->discount*$request->product_price)/100,
       'description'=>$request->description,
       'quantity' => $request->quantity,
       'size_exist' => $request->size_exists,
       'color' => $request->color,
    //    'slug' => str_replace('','-',$product_name).'-'.rand(0,1000000000),
       'created_at'=>Carbon::now(),
   ]);


$product_img = $request->product_image;
$ext = $product_img->getClientOriginalExtension();
$new_product_name = $product_id.'.'.$ext;

Image::make($product_img)->save(public_path('/uploads/products/preview/').$new_product_name);

product::find($product_id)->update([
    'product_image'=>$new_product_name,
]);

$start=1;
// $arr = 0;
// $color_arr = explode("/",$request->color);


foreach($request->file('product_thumb') as $single_thumb){
    //commented lines are for my creation. i created that the thumbnails name would be with colors name. as like, "1-1black.jpg"
    // $arr++;
    // $ex = $color_arr[$arr];
    $ext = $single_thumb->getClientOriginalExtension();
    // $new_product_thumb_name =$product_id.'-'.$start.$ex.'.'.$ext;
    $new_product_thumb_name =$product_id.'-'.$start.'.'.$ext;
    Image::make($single_thumb)->resize(500,500)->save(public_path('uploads/products/thumbnails/').$new_product_thumb_name);

    productThumbnail::insert([
        'product_id'=>$product_id,
        'product_thumbnail_name'=>$new_product_thumb_name,
        
        'created_at'=>Carbon::now(),
    ]); 
    $start++;
    
}

return back()->with('success','addition successful!!');
}
}
