<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;

class notifications extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new message instance.
     * @param App\Models\Order
     * @return void
     */
    public function __construct(Order $order)
    {
        //
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'service@syc.co.il';
        if (env('APP_ENV') == 'local')
            $address = 'narek@horizondvp.com';
        $name = 'RentInterSim';
        $subject = 'Order Status Change';
//        dd($this->data);

//        $order = Order::find($this->data['order']);
        $cc = [$this->order->editor->email,  $this->order->editor->email2];

        return $this->view('mail.notify')
            ->with('order', $this->order)
            ->cc($cc)
            ->bcc($address, $name)
            ->from($address, $name)
            ->subject($subject);
    }
}
