<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBookingUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $booking)
    {
        //
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'Central Bark Veterinary Clinic')
                    ->subject('Central Bark Veterinary Clinic - Booking Update')
                    ->markdown('emails.send_booking_update', [
                        'booking' => $this->booking,
                        'url' => route('customer.bookings.index'),

        ]); // with params
    }
}