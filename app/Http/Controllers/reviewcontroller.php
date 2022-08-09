<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\carbon;
use App\Models\review;

class reviewcontroller extends Controller
{
    function review(Request $request){
        review::insert([
            'product_id' =>$request->id,
            'user_id' =>Auth::guard('logan')->user()->id,
            'user_name' => Auth::guard('logan')->user()->name,
            'stars' => $request->star,
            'comment' => $request->comment,
            'created_at' => carbon::now(),
        ]);
        return back();
    }
}
