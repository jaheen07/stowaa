<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\carbon;
use App\Models\CustomerLogin;
use Cookie;

class customerloginController extends Controller
{
    function customer_login(Request $request){

        $get_url = $request->get_url;
        
        if($request->rememberme === null){
            setcookie('login_user',null,time()- 60*60);
            setcookie('login_pwd',null,time()- 60*60);
        }
        else{
            setcookie('login_user',$request->email,time()+60*60);
            setcookie('login_pwd',$request->password,time()+60*60);
        }

        if(Auth::guard('logan')->attempt(['email'=>$request->email, 'password'=> $request->password])){
            if(!empty($get_url)){
                
                return redirect($get_url);
            }
            else{
             return back()->with('success','You are logged in now!!');   
            }
            
        }
        else{
            return back()->with('error',"wrong info entered.please try again");
        }
    }


    function customer_register(Request $request){
        CustomerLogin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>bcrypt($request->password),
            'account_of' => 'stowaa',
            'created_at' =>Carbon::now(),
        ]);
        return back()->with('success','registration successful.');
    }

    function customer_logout(Request $request){
        Auth::guard('logan')->logout();
        return redirect('/log_reg');
    } 
}
