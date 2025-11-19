<?php

namespace App\Http\Resources\API;

use App\Models\Work;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public static $wrap = null;

    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'role'      => $this->role,
            'image'     => $this->image,
            'wallet'    => $this->wallet ? new WalletResource($this->wallet) : null,
            'locations' => UserLocationResource::collection($this->locations),
            'connections' => UserConnectionResource::collection($this->connections),
            'works'     => WorkResource::collection($this->works),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
