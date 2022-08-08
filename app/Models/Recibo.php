<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $fillable = array(
        'total',
        'observaciones',
        'punto_venta_id',
    );
    use HasFactory;
    public function puntoVenta(){
        return $this->belongsTo(PuntoVenta::class,'punto_venta_id','id');
    }
    public function facturas(){
        return $this->belongsToMany(Factura::class,'factura_recibo','recibo_id','factura_id')->withPivot('forma_pago_id','nro_cheque_transf','nro_recibo_tesoreria','banco_id','subtotal');
    }
}
