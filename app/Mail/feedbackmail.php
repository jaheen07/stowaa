<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class feedbackmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $name;
    public $email;
    public function __construct($all_data)
    {
        $this->data = $all_data;
        $this->email = $all_data['email'];
        $this->name = $all_data['name'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email,$this->name)
                    ->replyTo($this->email,$this->name)
                    ->view('frontend.feedback')
                    ->subject($this->data['subject'])
                    ->with([
                        'data' => $this->data,
                    ]);
    }
}
