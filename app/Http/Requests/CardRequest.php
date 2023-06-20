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
        $front = $this->input('front');
        $back = $this->input('back');
        
        foreach($front as $key => $text){
            if($text === null || $text === ''){
                $front[$key] = 'untitled';
            }
        }
        
        foreach($back as $key => $text){
            if($text === null || $text === ''){
                $back[$key] = 'untitled';
            }
        }
        
        $this->merge([
            'front' => $front,
            'back' => $back,
        ]);
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
