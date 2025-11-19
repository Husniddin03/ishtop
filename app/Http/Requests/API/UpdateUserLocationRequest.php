<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'latetude' => 'sometimes|numeric',
            'longitude' => 'sometimes|numeric',
        ];
    }
}
