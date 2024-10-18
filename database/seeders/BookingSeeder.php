<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Services\ActivityLogsService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {

        $bookings = array(
            [
                'id' => 1,
                'pet_id' => 1,
                'schedule_id' => 7,
                'payment_method_id' =>  1,
                'reference_no' => '1000312111',
                'status' => Booking::APPROVED,
                'remark' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'pet_id' => 1,
                'schedule_id' => 8,
                'payment_method_id' =>  1,
                'reference_no' => '1000312112',
                'status' => Booking::PENDING,
                'remark' => 'N/A',
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'pet_id' => 1,
                'schedule_id' => 9,
                'payment_method_id' =>  1,
                'reference_no' => '1000312112',
                'status' => Booking::CANCELED,
                'remark' => 'Wrong payment snapshot',
                'created_at' => now(),
            ]
        );

        Booking::insert($bookings);


        Booking::all()->each(function($booking) use($service) {

            $booking
                ->addMedia(public_path("/tmp_files/gcash.png"))
                ->preservingOriginal()
                ->toMediaCollection('payment_receipts');
                

            $service->log_activity(model:$booking, event:'book', model_name: 'Appointment', model_property_name: formatDate($booking->schedule->date_time_start). ' at ' . formatDate($booking->schedule->date_time_start, 'time'). ' - ' .formatDate($booking->schedule->date_time_end, 'time'), conjunction:'an', end_user: $booking->pet->customer->full_name);
        });

    }
}