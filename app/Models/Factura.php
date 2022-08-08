<?php

namespace App\Models;

use App\Scopes\FacturaSearchScope;
use App\Scopes\FilterScope;
use Attribute;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str as SupportStr;

class Factura extends Model
{
    protected $attributes =[
        'nro',
    ];
    protected $appends = [
        'nro',
    ];
    protected $table = 'facturas';
    protected $with = [
          'estado',
          'obraSocial',
          'puntoVenta'
      ];
      public $filterColumns=['obra_social_id'];
      use HasFactory;
      protected $fillable= array('obra_social_id','punto_venta_id','fecha_emision','fecha_ultimo_pago','fecha_acuse','importe','cobrado','estado_id','created_at','updated_at','observaciones');
      public function obraSocial(){
          return $this->belongsTo(ObraSocial::class,'obra_social_id','id');
      }
      public function puntoVenta(){
          return $this->belongsTo(PuntoVenta::class,'punto_venta_id','id');
      }
      public function estado(){
          return $this->belongsTo(Estado::class,'estado_id','id');
      }
      public function recibos(){
          return $this->belongsToMany(Recibo::class,'factura_recibo','factura_id','recibo_id')->withPivot('forma_pago_id','nro_cheque_transf','nro_recibo_tesoreria','banco_id','subtotal');
      }
      public function notasDebito(){
        return $this->belongsToMany(NotaDebito::class,'debito_factura','factura_id','nota_debito_id')->withPivot('subtotal')->using(FacturaDebito::class);
      }
      public function notasCredito(){
          return $this->belongsToMany(NotaCredito::class,'factura_nota','factura_id','nota_credito_id')->withPivot('subtotal')->using(FacturaNota::class);
      }
      public function scopeLatestFirst($query){
          return $query->orderby('id','desc');
      }
      public function setEstado(){
        if($this->cobrado == $this->importe ){
            $this->estado_id = 2;

        }elseif($this->cobrado < $this->importe){
            $this->estado_id= 4;
        }else{
            $this->estado_id= 1;
        }
      }

       /**
     * obtener numero de factura.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
      protected function getNroAttribute()
      {
        return SupportStr::padLeft($this->punto_venta_id,4,"0")."-".SupportStr::padLeft($this->id,8,"0");
      }
     public static function booted(){

      static::addGlobalScope(new FilterScope);
      static::addGlobalScope(new FacturaSearchScope);
     }
}
