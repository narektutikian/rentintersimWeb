<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Activation;
use App\User;

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
        $user = User::where('level', 'Super admin')->first();
        $address = $user->email;
        $name = 'SimRent';
        $subject = 'Failed Log';
        if (env('APP_ENV') == 'local')
        $subject = 'Failed Log (Dev)';

        $activations = Activation::whereIn('id', $this->items)->get();
        return $this->view('mail.activation')->with('activations', $activations)
            ->from($address, $name)
            ->bcc($user->email2)
            ->subject($subject);
    }
}
