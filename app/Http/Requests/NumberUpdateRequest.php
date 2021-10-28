<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NumberUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'value' => ['required', 'max:15'],
            'description' => 'required',
        ];
    }
}
