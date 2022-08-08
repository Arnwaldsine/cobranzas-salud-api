<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\map;

class StoreGestionRequest extends FormRequest
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
            'obra_social_id'=>'required|exists:obras_sociales,id',
            'contacto_id'=>'required|exists:contactos,id',
            'fecha_contacto'=>'nullable|date',
            'respuesta_id'=>'required|exists:respuestas,id',
            'fecha_proximo_contacto'=>'required|date',
            'observaciones'=>'nullable|string|max:150'
        ];
    }
    public function attributes()
    {
        return[
            'obra_social_id'=>'Obra Social',
            'contacto_id'=>'Contacto',
            'fecha_contacto'=>'Fecha de Contacto',
            'respuesta_id'=>'Respuesta',
            'fecha_proximo_contacto'=>'Fecha de proximo contacto',
        ];
    }
    public function messages(){
        return [
            '*.date'=>'Inserte una fecha válida',
            'observaciones.max'=>'Maximo 150 caracteres',
            'obra_social_id.exists'=>'La Obra Social indicada no existe',
            '*.required' => 'El campo :attribute es requerido'
        ];
    }
}
