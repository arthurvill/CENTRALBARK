<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Prescription\PrescriptionRequest;

class PrescriptionController extends Controller
{
    public function create(Booking $booking)
    {
        return view('admin.prescription.create', [
            'booking' => $booking
        ]);
    }

    public function store(PrescriptionRequest $request, Booking $booking)
    {
        $booking->prescriptions()->create($request->validated());

        return to_route('admin.bookings.show', $booking)->with('success', 'Prescription Added Successfully');
    }

    public function show(Booking $booking, Prescription $prescription)
    {
        return view('admin.prescription.show', [
            'booking' => $booking,
            'prescription' => $prescription
        ]);
    }
    
    public function edit(Booking $booking, Prescription $prescription)
    {
        return view('admin.prescription.edit', [
            'booking' => $booking,
            'prescription' => $prescription
        ]);
    }

    public function update(PrescriptionRequest $request, Booking $booking, Prescription $prescription)
    {
        $prescription->update($request->validated());

       
        return to_route('admin.bookings.show', $booking)->with('success', 'Prescription Updated Successfully');
    }

    public function destroy(Booking $booking, Prescription $prescription)
    {
        $prescription->delete();

        return back()->with('success', 'Prescription Deleted Successfully');
    }
}