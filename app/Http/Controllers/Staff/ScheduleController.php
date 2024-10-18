<?php

namespace App\Http\Controllers\Staff;

use Carbon\Carbon;
use App\Models\Service;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\ScheduleRequest;
use App\Http\Resources\Schedule\ScheduleResource;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {        
        if(request()->ajax())
        {
            $schedules = ScheduleResource::collection(
                Schedule::query()
                ->when(filled($request->service), fn($query) => $query->where('service_id',  $request->service))
                ->with('service')
                ->get()
            );

            return DataTables::of($schedules)
                   ->addIndexColumn()
                   ->make(true);
        }

        return view('staff.schedule.index', [
            'services' => Service::pluck('name', 'id'),
        ]);
    }

    public function create()
    {
        return view('staff.schedule.create', [
            'services' => Service::pluck('name', 'id'),
        ]);
    }

    public function store(ScheduleRequest $request)
    {
        if($request->type == "manual")
        {
            foreach(array_combine($request->date_time_start, $request->date_time_end) as $date_time_start => $date_time_end)
            {
                if(strtotime($date_time_start) >=  strtotime($date_time_end))
                {
                    return back()->with('error', 'Invalid Date Time Schedule: Start Date must not be greather than or equal to the End Date');
                }
                
                $schedule =  Schedule::create([
                    'service_id' => $request->service_id,
                    'date_time_start' => $date_time_start,
                    'date_time_end' => $date_time_end,
                    'day_type' => Carbon::parse($date_time_start)->isoFormat('dddd'),
                    'created_at' => now()
                ]);
            }

            return back()->with('success', "Clinic Schedule Added Successfully");
        }


        if($request->type == "bulk")
        {
            $time_starts = $request->time_start; // array
            $time_ends = $request->time_end; // array
            $day_types = $request->day_type; // array
            $no_of_days = $request->no_of_days; // array

           foreach($day_types as $index => $day_type)
           {
                $startDate = Carbon::today();

                $time_start = $time_starts[$index];
                $time_end = $time_ends[$index];
                $current_no_of_days = $no_of_days[$index];

                if(strtotime($time_start) >=  strtotime($time_end))
                {
                    return back()->with('error', "The time_start for entry {$index} must not be ahead of the time_end.");
                }
                
                // Start the loop for the number of days (no_of_days)
                for ($i = 0; $i < $current_no_of_days; $i++) {

                    $scheduleDate = $startDate->copy()->next($day_type); // Check the day_type and get the corresponding date

                    // Assign the time_start and time_end to the date
                    $date_time_start = Carbon::parse($scheduleDate->format('Y-m-d') . ' ' . $time_start);
                    $date_time_end = Carbon::parse($scheduleDate->format('Y-m-d') . ' ' . $time_end);


                    $schedule = Schedule::create([
                        'service_id' => $request->service_id,
                        'date_time_start' => $date_time_start,
                        'date_time_end' => $date_time_end,
                        'day_type' => $day_type,
                        'created_at' => now()
                    ]);

                    $startDate = $date_time_start;
                }
           }

            return back()->with('success', "Clinic Schedule Added Successfully");
        }
       
    }

    public function show(Schedule $schedule)
    {
        return view('staff.schedule.show', [
            'schedule' => $schedule->load('service' , 'booking')
        ]); 
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

       return $this->res(['success' => 'Clinic Schedule Deleted Successfully']);
    }
}