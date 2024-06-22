<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        self::withoutWrapping();

        $resource = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'cellphone_number' => $this->cellphone_number,
            'roles' => $this->getRoleNames(),
        ];

        return $resource;
    }
}
