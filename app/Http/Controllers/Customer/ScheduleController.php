<?php

namespace App\Http\Controllers\Customer;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\ScheduleService;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function __invoke(Service $service,  ScheduleService $schedule_service)
    {   
        return view('customer.schedule.index', [
            'service' => $service,
            'schedules' => $schedule_service->handle(service: $service->id)
        ]);
    }
}