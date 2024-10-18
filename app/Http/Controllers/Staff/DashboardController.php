<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function __construct()
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false
    }

    public function __invoke()
    {
        $customers = User::byRole('customer')->with('customer')->paginate(10);
        $bookings = Booking::query();

        return view('staff.dashboard.index',[
            'activities' => Activity::latest()->take(5)->get(),
            'recent_bookings' => $bookings->with('pet', 'schedule.service')->latest()->paginate(5),
            'total_booking' => $bookings->count(),
            'total_pending_booking' => $bookings->where('status', Booking::PENDING)->count(),
            'total_approved_booking' => $bookings->where('status', Booking::APPROVED)->count(),
            'total_canceled_booking' => $bookings->where('status', Booking::CANCELED)->count(),
            'total_customer' =>  User::byRole('customer')->count(),
            'customers' => $customers,
            // 'staffs' => MedicalStaff::has('other_schedules')->with('other_schedules')->get(), 
            'chart_monthly_customers' => $this->getMonthlyCustomers(),
            'chart_monthly_bookings' => $this->getMonthlyBookings(),
        ]);
    }

 
    protected function getMonthlyCustomers()
    {
        $monthly_customers = User::selectRaw("
        count(id) AS total_customers, 
        month(created_at) as month_no, 
        DATE_FORMAT(created_at, '%M-%Y') AS new_date,
        YEAR(created_at) AS year,
        monthname(created_at) AS month"
        )
        ->groupBy('new_date')
        ->orderByRaw('month_no')
        ->get();

        $months = array();
        
        $total_monthly_customers = array();

        foreach ($monthly_customers as $month) {
            $months[] = $month->month;
        }

        foreach ($monthly_customers as $total) {
            $total_monthly_customers[] = $total->total_customers;
        }

        return [$months, $total_monthly_customers]; // sorted
    }

    protected function getMonthlyBookings()
    {
        $monthly_bookings = Booking::selectRaw("
        count(id) AS total_customers, 
        month(created_at) as month_no, 
        DATE_FORMAT(created_at, '%M-%Y') AS new_date,
        YEAR(created_at) AS year,
        monthname(created_at) AS month"
        )
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
            $total_monthly_bookings[] = $total->total_customers;
        }

        return [$months, $total_monthly_bookings]; // sorted
    }
}