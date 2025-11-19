<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('user') ? $this->route('user')->id ?? $this->route('user') : null;

        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => ['sometimes','required','email', Rule::unique('users','email')->ignore($userId)],
            'password' => 'sometimes|nullable|string|min:6',
            'role' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
