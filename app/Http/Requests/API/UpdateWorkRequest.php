<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'type' => 'nullable|string|max:255',
            'descrition' => 'nullable|string',
            'date' => 'nullable|date',
        ];
    }
}
