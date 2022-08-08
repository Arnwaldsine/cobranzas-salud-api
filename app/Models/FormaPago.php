<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    use HasFactory;
    public function facturasRecibos(){
        $this->hasMany(FacturaRecibo::class,'forma_pago_id','id');
    }
}
