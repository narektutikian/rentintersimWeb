<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;
use App\User;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $order = Order::find($this->data['order']);

        $user = User::where('level', 'Super admin')->first();
        $address = $user->email;
        $name = 'SimRent';
        $subject = 'Your Order #'. $order->id;
        if (env('APP_ENV') == 'local')
            $subject = '(Dev) Your Order #'. $order->id;
//        dd($this->data);



        return $this->view('mail.mail')
            ->with('order', $order)
            ->with('text', $this->data['text'])
            ->from($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject);
    }
}
