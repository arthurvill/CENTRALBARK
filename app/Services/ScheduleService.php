<?php 

namespace App\Services;

use App\Models\Booking;
use App\Models\MedicalStaffService;
use App\Models\Schedule;
use App\Models\Service;

class ScheduleService {

    public function handle($service)
    {
        $schedules = array();

        $service = Service::find($service);

        $schedules = Schedule::whereBelongsTo($service)
        ->whereDate('date_time_start', '>=', now()->startOfDay()) // Get schedules for the current day or future dates
        ->where('date_time_end', '>', now()) // Schedules that have not ended yet
        ->get();


        foreach($schedules as $schedule) 
        {
            $route = match(auth()->user()->role->name) {
                'admin' => route('admin.schedules.show', $schedule->id),
                'customer' => route('customer.services.schedules.bookings.create', [$service, $schedule->id]),
            };

            // if status is reserved
            if($schedule->booking)
            {
                // check if its approved or canceled

                if($schedule->booking->status == Booking::APPROVED)
                {
                    $title = "Reserved";
            
                    $schedules[] = [
                        'title' => $title ,
                        'start' => $schedule->date_time_start,
                        'end' => $schedule->date_time_end,
                        'allDay' => false,
                        'eventResizableFromStart' => true,
                        'url' => $route,
                        'borderColor' => '#fb6340',
                        'backgroundColor' => '#fb6340'
                    ];
                }


                // if its canceled then make it available
                if($schedule->booking->status == Booking::CANCELED)
                {
                    // check if the date has passed today's date
                    //status - not available
                    if(date('Y-m-d') > $schedule->date_time_start) 
                    {
                        $title = "Not Available";
                        $schedules[] = [
                            'title' => $title ,
                            'start' => $schedule->date_time_start,
                            'end' => $schedule->date_time_end,
                            'allDay' => false,
                            'eventResizableFromStart' => true,
                            'url' => $route,
                            'borderColor' => '#ced4da',
                            'backgroundColor' => '#ced4da'
                        ];

                    }

                    else
                    {
                        // status - available
                        $title = "Available";
                
                        $schedules[] = [
                            'title' => $title ,
                            'start' => $schedule->date_time_start,
                            'end' => $schedule->date_time_end,
                            'allDay' => false,
                            'eventResizableFromStart' => true,
                            'url' => $route,
                            'borderColor' => '#74CD8A',
                            'backgroundColor' => '#74CD8A'
                        ];
                    }

                }
            }
            else
            {
                // if there is no booking it means its available
                // check if the date has passed today's date
                //status - not available
                if(date('Y-m-d') > $schedule->date_time_start) 
                {
                    $title = "Not Available";
                    $schedules[] = [
                        'title' => $title ,
                        'start' => $schedule->date_time_start,
                        'end' => $schedule->date_time_end,
                        'allDay' => false,
                        'eventResizableFromStart' => true,
                        'url' => $route,
                        'borderColor' => '#ced4da',
                        'backgroundColor' => '#ced4da'
                    ];

                }

                else
                {
                    // status - available
                    $title = "Available";
                    $schedules[] = [
                        'title' => $title, //"$schedule->id"
                        'start' => $schedule->date_time_start,
                        'end' => $schedule->date_time_end,
                        'allDay' => false,
                        'eventResizableFromStart' => true,
                        'url' => $route,
                        'borderColor' => '#74CD8A',
                        'backgroundColor' => '#74CD8A'
                    ];
                }
    
            }

        }

        return $schedules;

    }
}