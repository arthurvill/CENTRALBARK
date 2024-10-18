<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Staff;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\StaffRequest;
use App\Services\UserService;

class StaffController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Staff::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $route_show = route('admin.staffs.show', $row);
                    $route_edit = route('admin.staffs.edit', $row);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_show'>View</a>
                                <a class='dropdown-item' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`admin.staffs.destroy`,`.staff_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.staff.index');
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(StaffRequest $request, UserService $service)
    {
        $staff = Staff::create($request->validated());

        $service->create_account(model: $staff, email: $request->email, role: Role::STAFF);

        return to_route('admin.staffs.index')->with(['success' => 'Staff Added Successfully']);
    }

    public function show(Staff $staff)
    {
        return view('admin.staff.show', [
            'staff' => $staff->load('user.avatar'),
        ]);
    }
    
    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', [
            'staff' => $staff
        ]);
    }

    public function update(StaffRequest $request, Staff $staff)
    {
        $staff->update($request->validated());

        $staff->user()->updateOrCreate(
            ['role_id' => Role::STAFF],
            ['email' => $request->email],
        );

       return to_route('admin.staffs.index')->with(['success' => 'Staff Updated Successfully']);
    }
    public function destroy(Staff $staff)
    {
        $staff->delete();

       return $this->res(['success' => 'Staff Deleted Successfully']);
    }
}