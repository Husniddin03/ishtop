<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkerRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ican' => 'sometimes|string',
            'start_time' => 'sometimes|nullable|date_format:H:i',
            'finish_time' => 'sometimes|nullable|date_format:H:i',
        ];
    }
}
