<?php 

namespace App\Services;

use App\Mail\SendBookingUpdate;
use App\Models\Service;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendBookingUpdateForWalkin;
use App\Mail\SendRescheduleBookingUpdate;

class BookingService {

    public function notify($booking)
    {
        $this->send_sms(booking: $booking);

        return Mail::to($booking->pet->customer->user->email)->send(new SendBookingUpdate(booking: $booking));
    }

    public function notify_reschedule($old_schedule, $booking)
    {
        $this->send_reschedule_sms(booking: $booking);

        return Mail::to($booking->pet->customer->user->email)->send(new SendRescheduleBookingUpdate(old_schedule:$old_schedule, booking: $booking));
    }

    public function notify_walkin($booking)
    {
        $this->send_sms(booking: $booking);

        return Mail::to($booking->pet->customer->user->email)->send(new SendBookingUpdateForWalkin(booking: $booking));
    }

    public function notify_consultation_reminder($booking)
    {
        $customer = $booking->pet->customer;

        $date = formatDate($booking->schedule->date_time_start) . ' at ' . formatDate($booking->schedule->date_time_start, 'time'). ' - ' . formatDate($booking->schedule->date_time_end, 'time');

        $message = "Hi! $customer->full_name, we would like to inform you that you have an appointment schedule on $date.  - Central Bark Veterinary Clinic";

        $ch = curl_init();
        $parameters = array(
            'apikey' => config('app.sms_key'), 
            'number' => $customer->contact,
            'message' => $message,
            'sendername' => 'THESIS'
        );

        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        return $output;
        
    }
    
    public function send_sms($booking)
    {
        $customer = $booking->pet->customer;

        $service = $booking->schedule->service->name;
        
        $schedule = formatDate($booking->schedule->date_time_start). ' at ' . formatDate($booking->schedule->date_time_start, 'time') .' - ' .  formatDate($booking->schedule->date_time_end, 'time');
     
        $route = route('customer.bookings.show', $booking);

        $message = match($booking->status) {
            "1" => "Hi! $customer->full_name, your requested appointment schedule has been approved. Schedule: $schedule \n For more info visit the link $route - Central Bark Veterinary Clinic",
            "2" => "Hi! $customer->full_name, unfortunately your requested appointment schedule has been declined. For more info visit the link $route - Central Bark Veterinary Clinic",
        };

        $ch = curl_init();
        $parameters = array(
            'apikey' => config('app.sms_key'), 
            'number' => $customer->contact,
            'message' => $message,
            'sendername' => 'THESIS'
        );

        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        return $output;
    }

    public function send_reschedule_sms($booking)
    {
        $customer = $booking->pet->customer;

        $service = $booking->schedule->service->name;
        
        $schedule = formatDate($booking->schedule->date_time_start). ' at ' . formatDate($booking->schedule->date_time_start, 'time') .' - ' .  formatDate($booking->schedule->date_time_end, 'time');

        $route = route('customer.bookings.show', $booking);

        $message = "Hi! $customer->full_name, your requested appointment schedule has been moved. Your new schedule $schedule. \n.For more info visit the link $route - Central Bark Veterinary Clinic";

        $ch = curl_init();
        $parameters = array(
            'apikey' => config('app.sms_key'), 
            'number' => $customer->contact,
            'message' => $message,
            'sendername' => 'THESIS'
        );

        curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        return $output;
    }
}