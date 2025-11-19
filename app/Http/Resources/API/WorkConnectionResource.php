<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkConnectionResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'url'      => $this->url,
        ];
    }
}
