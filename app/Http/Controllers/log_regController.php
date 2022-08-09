<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerLogin;

class log_regController extends Controller
{
    function email(Request $request){
        
        if(CustomerLogin::where('email',$request->jaheen)->exists()){
                echo "email exists";
        }
        else if($request->jaheen == ""){
            echo "field null";
        }
        else{
            echo "no found";
        }
    }

    function pass(Request $request){
        if($request->khan >=8){
            echo "ok";
        }
        else if($request->khan == 0){
            echo "field null";
        }
        else{
            echo "less";
        }
    }
}
