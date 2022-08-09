<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class noticemail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $data = '';
    protected $ids = '';
    protected $order_number ='';
    public function __construct($all_data,$id,$order_number)
    {
        $this->data = $all_data;
        $this->ids = $id;
        $this->order_number = $order_number;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('invoice.invoice')->subject('your order has been placed.')->with([
            'datas' => $this->data,
            'ids' => $this->ids,
            'order_number' =>$this->order_number,
        ]);
    }
}
