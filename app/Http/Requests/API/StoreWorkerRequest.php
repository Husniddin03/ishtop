<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ican' => 'required|string',
            'finish_time' => 'nullable|date_format:H:i|required_with:start_time|after:start_time',
        ];
    }
}
