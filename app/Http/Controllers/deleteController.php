<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\subcategory;
use App\Models\cart;
use App\Models\banner;
use App\Models\wishlist;



class deleteController extends Controller
{
    function category_delete($id){
        category::find($id)->delete();
        return back();
    }

    function sub_category_delete($id){
        subcategory::find($id)->delete();
        return back();
    }


    function cart_delete($id){
        cart::find($id)->delete();
        return back();
    }

    function banner_delete($id){
        banner::find($id)->delete();
        return back();
    }

    function wishlist_delete($id){
        wishlist::find($id)->delete();
        return back();
    }
}
