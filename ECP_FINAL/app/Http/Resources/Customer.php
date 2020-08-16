<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'phone' => $this->phone,
            'street_number' => $this->street_number,
            'street_name' => $this->street_name,
            'zip_code' => $this->zip_code,
            'city' => $this->city,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'route_to_door' => $this->route_to_door,
            'birthday' => $this->birthday,
            'special_note' => $this->special_note,

            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),


        ];
    }
}
