<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Result;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;

class PrintController extends Controller
{
    public function __invoke(Request $request)
    {
        $booking = $request->booking;

        return match($request->records) {
            'result' => view('admin.result.print', [
                'results' => $this->get_booking_results(booking: $booking),
                'booking' => $booking,
            ]),

            'prescription' => view('admin.prescription.print', [
                'prescriptions' => $this->get_booking_prescriptions(booking: $booking),
                'booking' => $booking,
            ]),

            'general_report' => view('admin.general_report.print', [
                'available_service_categories' => ServiceCategory::with('services')->get(),
                'results' => $this->get_patients_by_date_range_and_service(),
            ]),

            'patients_report_summary' => view('admin.general_report.summary.print', [
                'results' => $this->get_report_summary(),
                'available_service_categories' => ServiceCategory::with('services')->get(),
            ]),
        };
    }

    private function get_booking_results($booking)
    {
        $date_started_at = request('date_started_at');
        $date_ended_at = request('date_ended_at');

        return Result::query()
        ->when(filled($date_started_at) && filled($date_ended_at), 
            fn($query) => $query->whereBetween('created_at', [Carbon::parse($date_started_at)->startOfDay(), Carbon::parse($date_ended_at)->endOfDay()]))
        ->when(filled($date_started_at) && blank($date_ended_at), 
            fn($query) => $query->whereDate('created_at', $date_started_at))
        ->when(filled($date_ended_at) && blank($date_started_at), 
            fn($query) => $query->whereDate('created_at', $date_ended_at ))
        ->when(blank($date_started_at) && blank($date_ended_at), 
            fn($query) => $query->whereDate('created_at', now()))
        ->whereRelation('booking', 'id', $booking)
        ->get();
    }

    private function get_booking_prescriptions($booking)
    {
        $date_started_at = request('date_started_at');
        $date_ended_at = request('date_ended_at');
        
        return Prescription::query()
        ->when(filled($date_started_at) && filled($date_ended_at), 
            fn($query) => $query->whereBetween('created_at', [Carbon::parse($date_started_at)->startOfDay(), Carbon::parse($date_ended_at)->endOfDay()]))
        ->when(filled($date_started_at) && blank($date_ended_at), 
            fn($query) => $query->whereDate('created_at', $date_started_at))
        ->when(filled($date_ended_at) && blank($date_started_at), 
            fn($query) => $query->whereDate('created_at', $date_ended_at ))
        ->when(blank($date_started_at) && blank($date_ended_at), 
            fn($query) => $query->whereDate('created_at', now()))
        ->whereRelation('booking', 'id', $booking)
        ->get();
    }

    private function get_patients_by_date_range_and_service()
    {
        $date_started_at = request('date_started_at');
        $date_ended_at = request('date_ended_at');
        $service = request('service');

        

        $results = Booking::has('schedule')
        ->when(filled($date_started_at) && filled($date_ended_at), 
        fn($query) => $query->whereBetween('created_at', [Carbon::parse($date_started_at)->startOfDay(), Carbon::parse($date_ended_at)->endOfDay()]))
        ->when(filled($date_started_at) && blank($date_ended_at), 
            fn($query) => $query->whereDate('created_at', $date_started_at))
        ->when(filled($date_ended_at) && blank($date_started_at), 
            fn($query) => $query->whereDate('date_time_out', $date_ended_at ))
        ->when(blank($date_started_at) && blank($date_ended_at), 
            fn($query) => $query->whereDate('created_at', now()))
        ->when(filled($service), fn($query) => $query->whereRelation('schedule.service', 'service_id', $service))
        ->with('pet', 'schedule.service')
        ->orderBy('id', 'desc')
        ->get();

        return $results;

    }

     /**
     * get all medical history ( booking with attached results)
     *
     * @return void
     */
    private function get_report_summary()
    {
        $date_started_at = request('date_started_at');
        $date_ended_at = request('date_ended_at');
        $selected_service = request('service');

        return Booking::query()
        ->when(filled($date_started_at) && filled($date_ended_at), 
            fn($query) => $query->whereBetween('created_at', [Carbon::parse($date_started_at)->startOfDay(), Carbon::parse($date_ended_at)->endOfDay()]))
        ->when(filled($date_started_at) && blank($date_ended_at), 
            fn($query) => $query->whereDate('created_at', $date_started_at))
        ->when(filled($date_ended_at) && blank($date_started_at), 
            fn($query) => $query->whereDate('date_time_out', $date_ended_at ))
        ->when(filled($selected_service), fn($query) => $query->whereRelation('schedule.service', 'service_id', $selected_service))
        ->with('schedule.service', 'results')
        ->get();
    }

}