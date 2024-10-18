@extends('layouts.admin.app')

@section('title', 'Admin | Manage Service Category')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3" href="javascript:void(0)"
                            onclick="toggle_modal('#m_service_category', '.service_category_form', ['#m_service_category_title','Add Service Category'], ['.btn_add_service_category','.btn_update_service_category'])">Create
                            Category +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover service_category_dt">
                                <caption>List of Service Service Category</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Service Categories --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
