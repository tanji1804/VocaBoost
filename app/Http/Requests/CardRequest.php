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
        if (!$this->filled('a_card')) {
            $this->merge(['a_card' => 'untitled']);
        }
        if(!$this->filled('b_card')){
            $this->merge(['b_card' => 'untitled']);
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
            'a_card' => 'required',
            'b_card' => 'required',
        ];
    }
}
