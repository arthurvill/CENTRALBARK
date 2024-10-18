<?php

namespace App\Http\Controllers\Staff;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Service\ServiceRequest;
use App\Models\ServiceCategory;

class ServiceController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Service::with('service_category')->get())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $route_edit = route('staff.services.edit', $row->id);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' role='button' href='$route_edit'>Edit</a>

                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('staff.service.index');
    }

    public function create()
    {
        return view('staff.service.create', [
            'service_categories' => ServiceCategory::pluck('name', 'id'),
        ]);
    }

    public function store(ServiceRequest $request)
    {
        Service::create($request->validated());

        return to_route('staff.services.index')->with(['success' => 'Service Added Successfully']);
    }

    public function edit(Service $service)
    {
        return view('staff.service.edit', [
            'service' => $service,
            'service_categories' => ServiceCategory::pluck('name', 'id'),
        ]);
    }

    public function update(ServiceRequest $request, Service $service)
    {
       $service->update($request->validated());

       return to_route('staff.services.index')->with(['success' => 'Service Updated Successfully']);
    }

    public function destroy(Service $service)
    {
        $service->delete();

       return $this->res(['success' => 'Service Deleted Successfully']);
    }
}