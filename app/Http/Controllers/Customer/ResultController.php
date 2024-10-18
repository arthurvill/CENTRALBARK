<?php

namespace App\Http\Controllers\Customer;

use App\Models\Result;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultController extends Controller
{
    public function __invoke(Booking $booking, Result $result)
    {
        return view('customer.result.show', [
            'booking' => $booking,
            'result' => $result
        ]);
    }
}