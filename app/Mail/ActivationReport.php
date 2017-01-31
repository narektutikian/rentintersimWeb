<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Activation;

class ActivationReport extends Mailable
{
    use Queueable, SerializesModels;

    protected $items;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($items)
    {
        //
        $this->items = $items;
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
        $subject = 'Failed Log';

        $activations = Activation::whereIn('id', $this->items)->get();
        return $this->view('mail.activation')->with('activations', $activations)
            ->from($address, $name)
            ->subject($subject);;
    }
}
