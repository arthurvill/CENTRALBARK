<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pet;
use App\Models\Result;
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Services\BookingService;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Resources\Booking\BookingResource;
use App\Http\Requests\Booking\AdminBookingRequest;

class BookingController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $bookings = BookingResource::collection(Booking::has('schedule')->with('pet.customer', 'schedule.service')->orderBy('id', 'desc')->get());
            
            return DataTables::of($bookings)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {
                    $new_row = collect($row);
                    $route_show = route('admin.bookings.show', $new_row['id']);
                    $btn = "
                    <div class='dropdown'>
                        <a class='btn btn-sm btn-icon-only text-light' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                        </a>
                        <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>
                            <a class='dropdown-item' href='$route_show'>View</a>";

                                if($new_row['status'] !== Booking::APPROVED)
                                {
                                    $btn.= "<a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($new_row[id],`admin.bookings.destroy`,`.booking_dt`)'>Delete</a>";
                                }
                               
                        $btn .= "</div>
                    </div>";
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.booking.index');
    }

    public function create()
    {
        return view('admin.booking.create', [
            'pets' => Pet::all(),
            'schedules' => Schedule::query()
            ->whereDate('date_time_start', '>=', now())
            ->get(), 
        ]);
    }

    public function store(AdminBookingRequest $request, BookingService $service)
    {
        $booking = Booking::create($request->validated() + ['is_online' => false, 'status' => Booking::APPROVED]);

        $service->notify_walkin(booking:$booking);

        $this->log_activity(model:$booking, event:'book', model_name: 'Appointment', model_property_name: formatDate($booking->schedule->date_time_start). ' at ' . formatDate($booking->schedule->date_time_start, 'time'). ' - ' .formatDate($booking->schedule->date_time_end, 'time'), conjunction:'an');

        return to_route('admin.bookings.index')->with('success', 'Appointment for Walk-in Added Successfully');
    }

    public function show(Booking $booking)
    {
        return view('admin.booking.show', [
            'booking' => $booking->load('pet.customer', 'schedule.service'),
            'schedules' => Schedule::query()
            ->where('service_id', $booking->schedule->service_id)
            ->whereDate('date_time_start', '>=', now())
            ->get(),
            'results' => Result::with('media')->whereBelongsTo($booking)->get(),
            'prescriptions' => Prescription::whereBelongsTo($booking)->get(),
        ]);
    }

    public function update(Request $request, Booking $booking, BookingService $service)
    {
        if($request->old_schedule) 
        {
            $old_schedule = Schedule::find($request->old_schedule);

            $booking->update($request->validate(['schedule_id' => 'required']) + ['status' => 1, 'remark' => $request->remark ?? ""]); // auto approved with remark

            $service->notify_reschedule(old_schedule:$old_schedule, booking:$booking);

            return back()->with('success', 'Booking Schedule Moved Successfully');
        }
        else
        {
            $booking->update($request->validate(['status' => 'required', 'remark' => 'sometimes']));
    
            $service->notify(booking: $booking->load('pet.customer.user', 'schedule.service')); // notify via email | sms
    
            return back()->with('success', 'Booking Request Updated Successfully');
        }
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return $this->res(['success' => 'Booking Record Deleted Successfully']);
    }
}