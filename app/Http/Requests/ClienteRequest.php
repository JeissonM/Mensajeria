<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'nombres' => 'required|max:250|min:3',
            'apellidos' => 'required|max:250|min:3',
            'telefono' => 'required|max:250|min:3',
            'direccion' => 'required|max:250|min:3'
        ];
    }

}
