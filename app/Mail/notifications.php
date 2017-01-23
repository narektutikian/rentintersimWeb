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
     * @param int
     * @return void
     */
    public function __construct($orderID)
    {
        //
        $this->order = Order::withTrashed()->find($orderID);
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
        $subject = 'Your Order #'. $this->order->id . ' is "'. $this->order->status. '" now';

        $cc = array($this->order->creator->email);
        if ($this->order->creator->email2 != '')
            $cc[] = $this->order->editor->email2;
        if ($this->order->editor != null)
            $cc[] = $this->order->editor->email;



        return $this->view('mail.notify')
            ->with('order', $this->order)
            ->cc($cc)
            ->bcc($address, $name)
            ->from($address, $name)
            ->subject($subject);
    }
}
