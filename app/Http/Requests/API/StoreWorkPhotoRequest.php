<?php
namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkPhotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'photos' => 'required|array|min:1|max:10',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}