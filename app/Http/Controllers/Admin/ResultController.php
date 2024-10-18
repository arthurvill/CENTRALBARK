<?php

namespace App\Http\Controllers\Admin;

use App\Models\Result;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\Result\ResultRequest;

class ResultController extends Controller
{
    public function create(Booking $booking)
    {
        return view('admin.result.create', [
            'booking' => $booking
        ]);
    }

    public function store(ResultRequest $request, Booking $booking, ImageUploadService $service)
    {
        $result = $booking->results()->create($request->validated());

        if($request->image)
        {
            $service->handleImageUpload(model: $result, images: $request->image, collection: 'booking_result_images', conversion_name:'card', action:'create');
        }

        return to_route('admin.bookings.show', $booking)->with('success', 'Result Added Successfully');
    }

    public function show(Booking $booking, Result $result)
    {
        return view('admin.result.show', [
            'booking' => $booking,
            'result' => $result
        ]);
    }
    
    public function edit(Booking $booking, Result $result)
    {
        return view('admin.result.edit', [
            'booking' => $booking,
            'result' => $result
        ]);
    }

    public function update(ResultRequest $request, Booking $booking, Result $result, ImageUploadService $service)
    {
        $result->update($request->validated());

        if($request->image)
        {
            $service->handleImageUpload(model: $result, images: $request->image, collection: 'booking_result_images', conversion_name:'card', action:'update');
        }

        return to_route('admin.bookings.show', $booking)->with('success', 'Result Updated Successfully');
    }

    public function destroy(Booking $booking, Result $result)
    {
        $result->delete();

        return back()->with('success', 'Result Deleted Successfully');
    }
}