<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotaCredito extends Model
{
    protected $table = 'notas_credito';
    protected $fillable = array('total','observaciones','punto_venta_id','fecha_emision');
    use HasFactory;
    public function puntoVenta(){
        return $this->belongsTo(PuntoVenta::class,'punto_venta_id','id');
    }
    public function facturas(){
        return $this->belongsToMany(Factura::class,'factura_nota','nota_credito_id','factura_id')->withPivot('subtotal')->using(FacturaNota::class);
    }
    use SoftDeletes;
}
