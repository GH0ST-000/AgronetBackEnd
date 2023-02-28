<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'last_name'=>$this->last_name,
            'user_types'=>$this->user_type,
            'country'=>$this->country,
            'email'=>$this->email,
        ];
    }
}
