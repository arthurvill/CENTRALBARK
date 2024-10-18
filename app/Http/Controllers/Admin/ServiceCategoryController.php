<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCategory\ServiceCategoryRequest;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(ServiceCategory::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_edit(`#m_service_category`, `.service_category_form :input`, [`#m_service_category_title`, `Edit Service Category`], [`.btn_add_service_category`, `.btn_update_service_category`], $row)'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`admin.service_categories.destroy`,`.service_category_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.service_category.index');
    }

    public function store(ServiceCategoryRequest $request)
    {
       ServiceCategory::create($request->validated());

       return $this->res(['success' => 'Service Category Added Successfully']);
    }

    public function update(ServiceCategoryRequest $request, ServiceCategory $service_category)
    {
       $service_category->update($request->validated());

       return $this->res(['success' => 'Service Category Updated Successfully']);
    }

    public function destroy(ServiceCategory $service_category)
    {
        $service_category->delete();

       return $this->res(['success' => 'Service Category Deleted Successfully']);
    }
}