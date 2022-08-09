<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\CustomerLogin;
use Carbon\carbon;
use Auth;

class socialloginController extends Controller
{
    function goto_github(){
        return Socialite::driver('github')->redirect();
    }


    function github_callback(){
        $user = Socialite::driver('github')->user();

        if(CustomerLogin::where('email',$user->getEmail())->where('account_of','github')->exists()){
          if(Auth::guard('logan')->attempt(['email'=>$user->getEmail(),'password'=>'securitypassword'])){
           return redirect()->back();
        }  
        }
        else{
          CustomerLogin::insert([
            'name' => $user->getNickname(),
            'email' => $user->getEmail(),
            'password'=>bcrypt('securitypassword'),
            'account_of'=> 'github',
            'created_at' => carbon::now(),
            ]);  
            
            if(Auth::guard('logan')->attempt(['email'=>$user->getEmail(),'password'=>'securitypassword','account_of'=>'github'])){
                return redirect('/log_reg')->with('success','account created and login successful'); 
            }
        }     
    }

    function goto_google(){
        return Socialite::driver('google')->stateless()->redirect();
    }


    function google_callback(){
        $user = Socialite::driver('google')->stateless()->user();

        if(CustomerLogin::where('email',$user->getEmail())->where('account_of','google')->exists()){
          if(Auth::guard('logan')->attempt(['email'=>$user->getEmail(),'password'=>'googlepassword'])){
           return redirect('/log_reg')->with('success','login successful'); 
        }  
        }
        else{
          CustomerLogin::insert([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password'=>bcrypt('googlepassword'),
            'account_of'=> 'google',
            'created_at' => carbon::now(),
            ]);  
            
            if(Auth::guard('logan')->attempt(['email'=>$user->getEmail(),'password'=>'googlepassword','account_of'=>'google'])){
                return redirect('/log_reg')->with('success','account created and login successful'); 
            }
        }     
    }


    function goto_facebook(){
        return Socialite::driver('facebook')->stateless()->redirect();
    }


    function facebook_callback(){
        $user = Socialite::driver('facebook')->stateless()->user();

        if(CustomerLogin::where('email',$user->getEmail())->where('account_of','facebook')->exists()){
          if(Auth::guard('logan')->attempt(['email'=>$user->getEmail(),'password'=>'facebookpassword'])){
           return redirect('/log_reg')->with('success','login successful'); 
        }  
        }
        else{
          CustomerLogin::insert([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password'=>bcrypt('facebookpassword'),
            'account_of'=> 'facebook',
            'created_at' => carbon::now(),
            ]);  
            
            if(Auth::guard('logan')->attempt(['email'=>$user->getEmail(),'password'=>'facebookpassword','account_of'=>'facebook'])){
                return redirect('/log_reg')->with('success','account created and login successful'); 
            }
        }     
    }
}
