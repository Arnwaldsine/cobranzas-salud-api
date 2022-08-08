<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeFacturaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'obra_social_id' =>'required|exists:facturas,id',
            'importe' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'observaciones' =>'required|max:200',
        ];
    }
    public function attributes(){
        return[
            'obra_social_id'=>'Obra social',
        ];
    }
    public function messages(){
        return[
            'observaciones.max'=>'Maximo 200 caracteres',
            "importe.regex"=>"Ingrese un importe válido",
            "*.required" => "El campo :attribute es requerido"
        ];
    }
}
