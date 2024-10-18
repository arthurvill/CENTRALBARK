<?php

namespace App\Http\Resources\Booking;

use App\Models\Service;
use App\Models\MedicalStaff;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'customer' => $this->pet->customer->full_name,
            'pet' => $this->pet->name,
            'service' => $this->schedule->service->name,
            'schedule' => formatDate($this->schedule->date_time_start). ' at ' . formatDate($this->schedule->date_time_start, 'time'). ' - ' .formatDate($this->schedule->date_time_end, 'time') ,
            'created_at' => $this->created_at->toDateString(),
            'status' => $this->status,
            'is_online' => $this->is_online
         ];
    }
}