<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\reset_pass_mail;
use App\Models\CustomerLogin;
use Carbon\carbon;

class passController extends Controller
{
    function index(){

        return view('frontend.for_new_pass');
        // $today = strtotime(carbon::now()->format('H:i:s'));
        // $alsotoday = strtotime(CustomerLogin::where('email','me.zacron@gmail.com')->first()->updated_at->format('H:i:s'));
        
        // if(CustomerLogin::where('email','me.zacron@gmail.com')->first()->reset_token != 'NULL'){
        //   if(date('i',$today - $alsotoday) > 10 )
        //     {
        //         CustomerLogin::where('email','me.zacron@gmail.com')->update([
        //             'reset_token' => 'NULL',
        //         ]);
        //         echo "done sir";
        //     } 
        //     else{
        //         echo "still have time";
        //     } 
        // }
        
        

        
        
    }

    function get_link(Request $request){
        
        $count =0;
        $query = CustomerLogin::where('email',$request->mail)->get();
        foreach($query as $qr){
            if($qr->account_of == 'stowaa'){
                $count = 1;
            }
        }
        
        if($count == 1){
            $user = CustomerLogin::where('email',$request->mail)->get()->first()->name;
            CustomerLogin::where('email',$request->mail)->update([
                'reset_token' => uniqid(),
            ]);
            $token_id = CustomerLogin::where('email',$request->mail)->first()->reset_token;
            Mail::to($request->mail)->send(new reset_pass_mail($user,$token_id));
            return back()->with('success',"Password reset link has been sent to your email.PLease check");  
        }
        else{
            return back()->with('error','No email found in database.Please enter registered email.');
        }
    }

    function reset($token){
        if(CustomerLogin::where('reset_token',$token)->exists()){
          return view('frontend.reset_link',[
            'token' => $token,
        ]);  
        }
        else{
            echo "<h1>Fatal Error 401. Session Expired</h1>";
        }
        
    }

    function success(Request $request){
        
    
        if($request->new_pass != $request->confirm_pass){
            return back()->with('error',"Password does not match.Please enter passwords carefully");
        }
        else if($request->new_pass == $request->confirm_pass){
            CustomerLogin::where('reset_token',$request->new_token)->update([
                'password' => bcrypt($request->new_pass),
                'reset_token' => 'NULL',
            ]);
            return view('frontend.reset_link',[
                'token' => 0,
            ])->with('success',"successfully changed password");
        }
    }
}
