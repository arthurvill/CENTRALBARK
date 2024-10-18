<?php

namespace App\Http\Controllers\Customer;

use App\Models\Result;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\CustomerBookingRequest;
use App\Services\ImageUploadService;

class BookingController extends Controller
{
    public function index()
    {
        return view('customer.booking.index', [
            'bookings' => Booking::with('schedule.service')->whereIn('pet_id', auth()->user()->customer->pets->pluck('id'))->get()
        ]);
    }

    public function show(Booking $booking)
    {

        return view('customer.booking.show', [
            'booking' => $booking->load('pet.customer', 'schedule.service'),
            'results' => Result::with('media')->whereBelongsTo($booking)->get(),
        ]);
    }

    public function create(Service $service, Schedule $schedule)
    {
        return view('customer.booking.create', [
            'service' => $service,
            'schedule' => $schedule,
            'pets' => auth()->user()->customer->pets->pluck('name', 'id'),
            'payment_methods' => PaymentMethod::online()->get()

        ]);
    }

    public function store(CustomerBookingRequest $request, Service $service, Schedule $schedule, ImageUploadService $image_upload_service)
    {
        // validate recaptcha

        $booking = Booking::create($request->validated());

        $image_upload_service->handleImageUpload(model: $booking, images: $request->image, collection: 'payment_receipts', conversion_name: 'card', action: 'create');

        $this->log_activity(model:$booking, event:'book', model_name: 'Appointment', model_property_name: formatDate($booking->schedule->date_time_start). ' at ' . formatDate($booking->schedule->date_time_start, 'time'). ' - ' .formatDate($booking->schedule->date_time_end, 'time'), conjunction:'an');

        return to_route('customer.bookings.index')->with('success', 'Your appointment request has been successfully submitted. You will receive an email and text message notification whenever there is an update regarding your request.');
    }
}