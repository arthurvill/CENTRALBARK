<?php

namespace App\Http\Resources\Schedule;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'service' => $this->service->name,
            'date_time_start' => $this->date_time_start,
            'date_time_end' => $this->date_time_end,
            'day_type' => $this->day_type,
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}