<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkerResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_name' => $this->user->name,
            'user_id' => $this->user_id,
            'ican' => $this->ican,
            'start_time' => $this->start_time,
            'finish_time' => $this->finish_time,
        ];
    }
}
