<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoVenta extends Model
{
    protected $table = 'puntos_venta';

    use HasFactory;
    public function facturas(){
        return $this->hasMany(Factura::class,'punto_venta_id','id');
    }
    public function notasCredito(){
        return $this->hasMany(NotaCredito::class,'punto_venta_id','id');
    }
    public function users(){
        return $this->hasMany(User::class, 'user_id','id');
    }}
