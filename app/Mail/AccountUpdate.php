<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $user)
    {
    }
   
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'Central Bark Veterinary Clinic')
                    ->subject('Central Bark Veterinary Clinic - Account Status Update')
                    ->markdown('emails.account_update', [
                        'user' => $this->user,
                        'url' => route('auth.login'),

        ]); // with params
    }
}