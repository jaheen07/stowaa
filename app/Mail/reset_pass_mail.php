<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class reset_pass_mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     protected $data = '';
     protected $token ='';
    public function __construct($user,$token_id)
    {
        $this->data = $user;
        $this->token = $token_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //this is for sending plain text not a view(blade.php)
        $mssg = 'Hello '.$this->data.',<br>here is your password reset link:<br><a href="'.url('/reset_pass').'/'.$this->token.'">stowaa.com/reset_pass</a>';
        return $this->html($mssg)->subject('New Password Restoration Link');

    }
}
