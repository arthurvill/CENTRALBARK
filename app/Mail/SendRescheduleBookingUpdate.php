<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRescheduleBookingUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $old_schedule , public $booking)
    {
        //
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'Central Bark Veterinary Clinic')
                    ->subject('Central Bark Veterinary Clinic - Booking Reschedule Update')
                    ->markdown('emails.send_reschedule_booking_update', [
                        'booking' => $this->booking,
                        'old_schedule' => $this->old_schedule,
                        'url' => route('customer.bookings.index'),

        ]); // with params
    }
}