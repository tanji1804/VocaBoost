<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function prepareForValidation()
    {
        if (!$this->filled('front')) {
            $this->merge(['front' => 'untitled']);
        }
        if(!$this->filled('back')){
            $this->merge(['back' => 'untitled']);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'front' => 'required',
            'back' => 'required',
        ];
    }
}
