<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data_order;
    public $data_product;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_order, $data_product)
    {
        $this->data_order = $data_order;
        $this->data_product = $data_product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mails.mailorder')->subject("Hủy đơn hàng");
    }
}
