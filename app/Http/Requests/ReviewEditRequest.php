<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewEditRequest extends FormRequest {
    
    public function authorize() {
        return true;
    }
    
    public function attributes() {
        return [
            'type' => 'Tipo de la review',
            'title' => 'Título de la review',
            'review' => 'Contenido de la review',
            'iduser' => 'Usuario de la review',
            'idimage' => 'Imagen principal de la review',
            'idcategory' => 'Categoría de la review',
            'rate' => 'Calificacion',
        ];
    }

    public function rules() {
        return [
            'type' => 'required',
            'title' => 'required|string|min:1|max:50',
            'review' => 'required|string|min:1|max:100000',
            'iduser' => 'required|string',
            'idimage' => 'required',
            'idcategory' => 'required',
            'rate' => 'required',
        ];
    }
    
    public function messages() {
        $required = 'El campo :attribute es obligatorio';
        $string = 'El campo :attribute debe ser de tipo string';
        $min = 'El campo :attribute no puede tener menos de :min caracteres';
        $max = 'El campo :attribute no puede tener más de :max caracteres';
        
        return [
            'type.required' => $required,
            'title.required' => $required,
            'title.string' => $string,
            'title.min' => $min,
            'title.max' => $max,
            'review.required' => $required,
            'review.string' => $string,
            'review.min' => $min,
            'review.max' => $max,
            'iduser.required' => $required,
            'idimage.required' => $required,
            'idcategory.required' => $required,
            'rate.required' => $required,
        ];
    }
}
