<?php

namespace App\Http\Controllers\Customer;

use App\Models\Pet;
use App\Models\Booking;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\VaccinationHistory;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\Pet\CustomerPetRequest;

class PetController extends Controller
{
    public function index()
    {
       return view('customer.pet.index', [
        'pets' => Pet::with('media')->whereBelongsTo(auth()->user()->customer)->latest()->paginate(9),
       ]);
    }

    public function create()
    {
        return view('customer.pet.create', [
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    public function store(CustomerPetRequest $request, ImageUploadService $service)
    {
        $pet = auth()->user()->customer->pets()->create($request->validated());
        
        if($request->image)
        {
            $service->handleImageUpload(model:$pet, images: $request->image, collection:'avatar_image', conversion_name:'avatar', action:'create');
        }

        return to_route('customer.pets.index')->with(['success' => 'Pet Added Successfully']);
    }
    
    public function show(Pet $pet)
    {
        return view('customer.pet.show', [
            'pet' => $pet->load('customer', 'category'),
            'bookings' => Booking::with('schedule.service')->whereBelongsTo($pet)->paginate(6),
            'vaccination_histories' => VaccinationHistory::whereBelongsTo($pet)->paginate(6),
        ]);
    }

    public function edit(Pet $pet)
    {
        return view('customer.pet.edit', [
            'pet' => $pet,
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    public function update(CustomerPetRequest $request, ImageUploadService $service, Pet $pet)
    {
        $pet->update($request->validated());

        if($request->image)
        {
            $service->handleImageUpload(model:$pet, images: $request->image, collection:'avatar_image', conversion_name:'avatar', action:'create');
        }

        return to_route('customer.pets.index')->with(['success' => 'Pet Updated Successfully']);

    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

       return back()->with(['success' => 'Pet Deleted Successfully']);
    }
}