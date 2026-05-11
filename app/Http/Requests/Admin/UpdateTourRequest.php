<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTourRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'integer', 'min:1'],
            'departure' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'image' => ['nullable', 'url'],
            'description' => ['nullable', 'string'],
            'itinerary' => ['nullable', 'string'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
        ];
    }
}
