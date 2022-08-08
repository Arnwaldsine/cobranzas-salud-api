<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrestador extends Model
{
    protected $table = 'tipos_prestadores';
    use HasFactory;

    public function obrasSociales(){
        return $this->hasMany(ObraSocial::class,'tipo_prestador_id','id');
    }
}
