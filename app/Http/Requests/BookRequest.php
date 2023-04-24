<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function prepareForValidation()
    {
        if (!$this->filled('name')) {
            $this->merge(['name' => 'untitled']);
        }
    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}