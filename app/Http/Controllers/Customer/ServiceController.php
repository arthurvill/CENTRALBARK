<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __invoke()
    {
        return view('customer.service.index', [
            'service_categories' => ServiceCategory::with('services')->get(),
        ]);
    }
}