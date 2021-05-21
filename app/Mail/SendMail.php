<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $data_product;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $data_product)
    {
        $this->data = $data;
        $this->data_product = $data_product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mails.order');
    }
}