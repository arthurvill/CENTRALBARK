<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\Pet;
use App\Services\UserService;

class CustomerController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Customer::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $route_show = route('admin.customers.show', $row);
                    $route_edit = route('admin.customers.edit', $row);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_show'>View</a>
                                <a class='dropdown-item' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`admin.customers.destroy`,`.customer_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.customer.index');
    }

    public function create()
    {
        return view('admin.customer.create');
    }

    public function store(CustomerRequest $request, UserService $service)
    {
        $customer = Customer::create($request->validated());

        $service->create_account(model: $customer, email: $request->email, role: Role::CUSTOMER);

        return to_route('admin.customers.index')->with(['success' => 'Customer Added Successfully']);
    }

    public function show(Customer $customer)
    {
        return view('admin.customer.show', [
            'customer' => $customer->load('user.avatar'),
            'pets' => Pet::with('media')->whereBelongsTo($customer)->latest()->paginate(12),
        ]);
    }
    
    public function edit(Customer $customer)
    {
        return view('admin.customer.edit', [
            'customer' => $customer
        ]);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        $customer->user()->updateOrCreate(
            ['role_id' => Role::CUSTOMER],
            ['email' => $request->email],
        );

       return to_route('admin.customers.index')->with(['success' => 'Customer Updated Successfully']);
    }
    public function destroy(Customer $customer)
    {
        $customer->delete();

       return $this->res(['success' => 'Customer Deleted Successfully']);
    }
}