<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest {
    
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'User name',
            'email' => 'User email',
        ];
    }
    
    public function messages() {
        $required = 'The :attribute field is required';
        $string = 'The :attribute field must be a string';
        $min = 'The :attribute field cannot be less than :min characters';
        $max = 'The :attribute field cannot be longer than :max characters';
        
        return [
            'name.required' => $required,
            'name.string' => $string,
            'name.min' => $min,
            'name.max' => $max,
            'email.required' => $required,
            'email.string' => $string,
            'email.min' => $min,
            'email.max' => $max,
        ];
    }
}
