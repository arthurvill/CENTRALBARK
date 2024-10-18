<?php

namespace App\Http\Controllers\Staff;

use App\Models\Pet;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Resources\Pet\PetResource;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Pet\StaffPetRequest;
use App\Models\VaccinationHistory;

class PetController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $pets = PetResource::collection(Pet::query()
                ->when($request->filled('category'), fn($query) => $query->where('category_id', $request->category))
                ->with('category', 'customer', 'media')
                ->get()
            );

            return DataTables::of($pets)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);

                    $route_show = route('staff.pets.show', $new_row['id']);
                    $route_edit = route('staff.pets.edit', $new_row['id']);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' role='button' href='$route_show'>View</a>
                                <a class='dropdown-item' role='button' href='$route_edit'>Edit</a>

                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('staff.pet.index', [
            'categories' => Category::has('pets')->pluck('name', 'id'),
        ]);
    }


    public function create()
    {
        return view('staff.pet.create', [
            'categories' => Category::pluck('name', 'id'),
            'customers' => Customer::all(),
        ]);
    }

    public function store(StaffPetRequest $request, ImageUploadService $service)
    {
        $pet = Pet::create($request->validated());
        
        if($request->image)
        {
            $service->handleImageUpload(model:$pet, images: $request->image, collection:'avatar_image', conversion_name:'avatar', action:'create');
        }

        return to_route('staff.pets.index')->with(['success' => 'Pet Added Successfully']);
    }
    
    public function show(Pet $pet)
    {
        return view('staff.pet.show', [
            'pet' => $pet->load('customer', 'category'),
            'bookings' => Booking::with('schedule.service')->whereBelongsTo($pet)->paginate(6),
            'vaccination_histories' => VaccinationHistory::whereBelongsTo($pet)->paginate(6),
        ]);
    }

    public function edit(Pet $pet)
    {
        return view('staff.pet.edit', [
            'pet' => $pet,
            'categories' => Category::pluck('name', 'id'),
            'customers' => Customer::all(),
        ]);
    }

    public function update(StaffPetRequest $request, ImageUploadService $service, Pet $pet)
    {
        $pet->update($request->validated());

        if($request->image)
        {
            $service->handleImageUpload(model:$pet, images: $request->image, collection:'avatar_image', conversion_name:'avatar', action:'create');
        }

        return to_route('staff.pets.index')->with(['success' => 'Pet Updated Successfully']);

    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

       return $this->res(['success' => 'Pet Deleted Successfully']);
    }
}