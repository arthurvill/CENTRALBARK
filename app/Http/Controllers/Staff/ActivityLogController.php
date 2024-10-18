<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function __invoke()
    {
        if(request()->ajax())
        {
            $activities = Activity::where('causer_type', "App\Models\User")->where('causer_id', auth()->id())
            ->latest()
            ->get();

            return DataTables::of($activities)
            ->addIndexColumn()
            ->make(true);
        }
        
        return view('staff.activitylog.index');  
    }
}