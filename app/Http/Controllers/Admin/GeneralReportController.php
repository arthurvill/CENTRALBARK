<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;

class GeneralReportController extends Controller
{
    public function __invoke()
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false

        return view('admin.general_report.index', [
            'available_service_categories' => ServiceCategory::with('services')->get(),
            'chart_total_patient_by_date_range_and_service' => $this->get_total_patient_by_date_range_and_service(),
            'chart_total_monthly_customer' => $this->get_total_monthly_customer(),
            'chart_total_monthly_booking' => $this->get_total_monthly_booking(),
            'chart_total_schedule_by_service' => $this->get_total_schedule_by_service(),
            'patients_by_date_range_and_service' => $this->get_patients_by_date_range_and_service(),
            'patients_report_summary' => $this->get_patients_report_summary(),
        ]);
    }

    /**
     * get the total patient by date range and service
     *
     * @return void
     */
    private function get_total_patient_by_date_range_and_service()
    {
        $date_started_at = request('date_started_at');
        $date_ended_at = request('date_ended_at');
        $selected_service = request('service');
        $services = [];
        $total_bookings = [];

        if($selected_service)
        {
            $service = Service::find($selected_service);

            $services[] = $service->name;
            
            $total_bookings[] = Booking::query()
            ->when(filled($date_started_at) && filled($date_ended_at), 
                fn($query) => $query->whereBetween('created_at', [Carbon::parse($date_started_at)->startOfDay(), Carbon::parse($date_ended_at)->endOfDay()]))
            ->when(filled($date_started_at) && blank($date_ended_at), 
                fn($query) => $query->whereDate('created_at', $date_started_at))
            ->when(filled($date_ended_at) && blank($date_started_at), 
                fn($query) => $query->whereDate('date_time_out', $date_ended_at ))
            ->when(blank($date_started_at) && blank($date_ended_at), 
                fn($query) => $query->whereDate('created_at', now()))
            ->whereRelation('schedule.service', 'service_id', $service->id)
            ->where('status', Booking::APPROVED)
            ->count();

        }

        else
        {
            foreach(Service::has('schedules')->get() as $service)
            {

                $services[] = $service->name;
                $total_bookings[] = Booking::query()
                ->when(filled($date_started_at) && filled($date_ended_at), 
                    fn($query) => $query->whereBetween('created_at', [Carbon::parse($date_started_at)->startOfDay(), Carbon::parse($date_ended_at)->endOfDay()]))
                ->when(filled($date_started_at) && blank($date_ended_at), 
                    fn($query) => $query->whereDate('created_at', $date_started_at))
                ->when(filled($date_ended_at) && blank($date_started_at), 
                    fn($query) => $query->whereDate('date_time_out', $date_ended_at ))
                ->when(blank($date_started_at) && blank($date_ended_at), 
                    fn($query) => $query->whereDate('created_at', now()))
                ->when(filled($selected_service), fn($query) => $query->whereRelation('schedule.service', 'service_id', $selected_service))
                ->when(blank($selected_service), fn($query) => $query->whereRelation('schedule.service', 'service_id', $service->id))
                ->where('status', Booking::APPROVED)
                ->count();
            }
        }

        return [$services, $total_bookings];

    }

    /**
     * get total monthly customer
     *
     * @return void
     */
    private function get_total_monthly_customer()
    {
        $monthly_customers = User::selectRaw("
        count(id) AS total_users, 
        month(created_at) as month_no, 
        DATE_FORMAT(created_at, '%M-%Y') AS new_date,
        YEAR(created_at) AS year,
        monthname(created_at) AS month"
        )
        ->where('role_id', Role::CUSTOMER)
        ->groupBy('new_date')
        ->orderByRaw('month_no')
        ->get();

        $months = array();
        
        $total_monthly_customers = array();

        foreach ($monthly_customers as $month) {
            $months[] = $month->month;
        }

        foreach ($monthly_customers as $total) {
            $total_monthly_customers[] = $total->total_users;
        }

        return [$months, $total_monthly_customers]; // sorted
    }

    /**
     * get total monthly booking
     *
     * @return void
     */
    private function get_total_monthly_booking()
    {
        $date_started_at = request('date_started_at');
        $date_ended_at = request('date_ended_at');
        
        $monthly_bookings = Booking::selectRaw("
        count(id) AS total_users, 
        month(created_at) as month_no, 
        DATE_FORMAT(created_at, '%M-%Y') AS new_date,
        YEAR(created_at) AS year,
        monthname(created_at) AS month"
        )
        ->when(filled($date_started_at) && filled($date_ended_at), 
        fn($query) => $query->whereBetween('created_at', [Carbon::parse($date_started_at)->startOfDay(), Carbon::parse($date_ended_at)->endOfDay()]))
        ->when(filled($date_started_at) && blank($date_ended_at), 
            fn($query) => $query->whereDate('created_at', $date_started_at))
        ->when(filled($date_ended_at) && blank($date_started_at), 
            fn($query) => $query->whereDate('date_time_out', $date_ended_at ))
        // ->when(blank($date_started_at) && blank($date_ended_at), 
        //     fn($query) => $query->whereDate('created_at', now()))
        ->groupBy('new_date')
        ->orderByRaw('month_no')
        ->where('status', Booking::APPROVED)
        ->get();

        $months = array();
        
        $total_monthly_bookings = array();

        foreach ($monthly_bookings as $month) {
            $months[] = $month->month;
        }

        foreach ($monthly_bookings as $total) {
            $total_monthly_bookings[] = $total->total_users;
        }

        return [$months, $total_monthly_bookings]; // sorted
    }

    /**
     * get the total medical staff by service
     *
     * @return void
     */
    private function get_total_schedule_by_service()
    {
        $available_services = Service::has('schedules')->get();

        $services = [];
        $total_schedule = [];
        
        foreach($available_services as $service)
        {
            $services[] = $service->name;
            $total_schedule[] = $service->schedules->count();
        }

        return [
            $services,
            $total_schedule
        ];
    }


    // Tabular

    /**
     * get all patients by date range and service
     *
     * @return void
     */
    private function get_patients_by_date_range_and_service()
    {
        $date_started_at = request('date_started_at');
        $date_ended_at = request('date_ended_at');
        $service = request('service');

        return Booking::has('schedule')
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

    }


     /**
     * get all patients medical report summary
     *
     * @return void
     */
    private function get_patients_report_summary()
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
        // ->when(blank($date_started_at) && blank($date_ended_at), 
        // fn($query) => $query->whereDate('created_at', now()))
        ->with('schedule.service', 'results')
        ->get();

       
    }
}