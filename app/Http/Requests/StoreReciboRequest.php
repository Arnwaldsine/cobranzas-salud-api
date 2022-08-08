<?php

namespace App\Http\Requests;

use App\Models\Factura;
use Illuminate\Foundation\Http\FormRequest;

class StoreReciboRequest extends FormRequest
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
    public function montosValidos($facturas){
        foreach($facturas as $factura){
            if($factura['subtotal'] > Factura::find($factura['factura_id'])->debe){
                return false;
            }
        }
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
            'observaciones'=>'nullable|string:150',
            'facturas.*.factura_id'=>'required|exists:facturas,id',
            'facturas.*.forma_pago_id'=>'required|exists:formas_pago,id',
            'facturas.*.nro_cheque_transf'=>'required',
            'facturas.*.nro_recibo_tesoreria'=>'required',
            'facturas.*.banco_id'=>'required|exists:bancos,id',
            'facturas.*.subtotal'=>'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/'
        ];
    }
    public function attributes(){
        return[
        'factura_id'=>'Factura',
        'facturas.*.forma_pago_id'=>'Forma de Pago'
        ];
    }
    public function messages(){
        return[
            'subtotal.regex'=>"Ingrese un importe válido"
        ];
    }
}
