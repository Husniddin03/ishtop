<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLocationResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'latitude'  => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
