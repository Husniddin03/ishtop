<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkVideoResource extends JsonResource
{

    public static $wrap = null;

    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'url'      => $this->url,
        ];
    }
}
