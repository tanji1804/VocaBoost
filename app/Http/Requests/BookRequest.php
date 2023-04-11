<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function prepareForValidation()
    {
        if (!$this->filled('book_name')) {
            $this->merge(['book_name' => 'untitled']);
        }
    }

    public function rules()
    {
        return [
            'book_name' => 'required',
        ];
    }
}