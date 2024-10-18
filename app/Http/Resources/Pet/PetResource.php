<?php

namespace App\Http\Resources\Pet;

use Illuminate\Http\Resources\Json\JsonResource;

class PetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id, 
            'category' => $this->category->name,
            'customer' => $this->customer->full_name,
            'name' => $this->name,
            'sex' => $this->sex,
            'birth_date' => $this->birth_date,
            'breed' => $this->breed,
            'color' => $this->color,
            'weight' => $this->weight,
            'avatar' => $this->avatar_profile,
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}