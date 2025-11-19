<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public $collects = UserResource::class;

    public static $wrap = null; // ⚡ Bu collection uchun data wrapperni olib tashlaydi

    public function toArray($request): array
    {
        return [
            'current_page' => $this->currentPage(),
            'last_page' => $this->lastPage(),
            'per_page' => $this->perPage(),
            'total' => $this->total(),
            'users' => $this->collection, // ⚡ users array to‘g‘ridan-to‘g‘ri
        ];
    }
}
