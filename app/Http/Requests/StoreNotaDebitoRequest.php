<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotaDebitoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'observaciones'=>'required|string|max:200',
            'facturas.*.factura_id'=>'required|exists:facturas,id',
            'facturas.*.subtotal'=>'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        ];
    }
    public function attributes()
    {
        return[
            'facturas.*.factura_id'=>'Factura',
        ];
    }
    public function messages(){
        return[
            '*.required'=>'El campo :attribute es requerido',
            'observaciones.max'=>'Maximo 200 caracteres',
            'facturas.*.subtotal'=>'Ingrese un importe válido'
        ];

    }
}
