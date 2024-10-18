<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VaccinationHistory\VaccinationHistoryRequest;
use App\Models\Pet;
use App\Models\VaccinationHistory;
use Illuminate\Http\Request;

class VaccinationHistoryController extends Controller
{
    public function create(Pet $pet)
    {
        return view('admin.vaccination_history.create', [
            'pet' => $pet
        ]);
    }

    public function store(VaccinationHistoryRequest $request, Pet $pet)
    {
        $pet->vaccination_histories()->create($request->validated());

        return to_route('admin.pets.show', $pet)->with(['success' => 'Vaccination History Added Successfully']);
    }

    public function edit(Pet $pet, VaccinationHistory $vaccination_history)
    {
        return view('admin.vaccination_history.edit', [
            'pet' => $pet,
            'vaccination_history' => $vaccination_history
        ]);
    }

    public function update(VaccinationHistoryRequest $request, Pet $pet, VaccinationHistory $vaccination_history)
    {
        $vaccination_history->update($request->validated());

        return to_route('admin.pets.show', $pet)->with('success', 'Vaccination History Updated Successfully');
    }

    public function destroy(Pet $pet, VaccinationHistory $vaccination_history)
    {
        $vaccination_history->delete();

        return back()->with('success', 'Vaccination History Deleted Successfully');
    }
}