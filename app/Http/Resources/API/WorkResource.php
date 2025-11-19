<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkResource extends JsonResource
{

    public static $wrap = null;

    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'user_id'     => $this->user_id,
            'user_name'   => $this->user->name,
            'type'        => $this->type,
            'descrition' => $this->descrition,
            'date'        => $this->date,
            'connections' => WorkConnectionResource::collection($this->connections),
            'locations'   => WorkLocationResource::collection($this->locations),
            'photos'      => WorkPhotoResource::collection($this->photos),
            'videos'      => WorkVideoResource::collection($this->videos),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
