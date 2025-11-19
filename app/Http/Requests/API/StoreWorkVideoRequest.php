<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkVideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'videos' => 'required|array|min:1|max:3',
            'videos.*' => 'file|max:51200' // 
        ];
    }
}
