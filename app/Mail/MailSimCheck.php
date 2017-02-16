<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Activation;
use App\User;

class MailSimCheck extends Mailable
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
        $subject = 'SimRent Delayed Swaps';
        if (env('APP_ENV') == 'local')
            $subject = 'SimRent Delayed Swaps (Dev)';

        $activations = Activation::whereIn('id', $this->items)->get();
        return $this->view('mail.clierror')->with('activations', $activations)
            ->from($address, $name)
            ->cc($user->email2)
            ->subject($subject);
    }
}
