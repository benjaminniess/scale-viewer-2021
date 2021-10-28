<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => ['required', 'max:90'],
            'description' => 'required',
        ];
    }
}
