<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotaDebito extends Model
{
    protected $fillable = array('total','observaciones','punto_venta_id','fecha_emision');
    public function puntoVenta(){
        return $this->belongsTo(PuntoVenta::class,'punto_venta_id','id');
    }
    public function facturas(){
        return $this->belongsToMany(Factura::class,'debito_factura','nota_debito_id','factura_id')->withPivot('subtotal')->using(FacturaDebito::class);
    }
    use HasFactory;
    use SoftDeletes;
}
