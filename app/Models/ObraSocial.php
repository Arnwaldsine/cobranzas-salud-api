<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
class ObraSocial extends Model
{
    protected $attributes = ['total_deuda'];
    protected $appends = ['total_deuda'];
    protected $table = 'obras_sociales';
    protected $fillable = array(
    'rnos',
    'nombre',
    'cuit',
    'telefono',
    'direccion',
    'cp',
    'pagina',
    'horario_admin',
    'contacto_admin',
    'tel_admin',
    'contacto_geren-1',
    'contacto_geren-2',
    'tel_gere',
    'tel_geren',
    'observaciones',
    'tipo_prestador_id',
);
    use HasFactory;
    public function tipoPrestador(){
        return $this->belongsTo(TipoPrestador::class,'tipo_prestador_id','id');
    }
    public function facturas(){
        return $this->hasMany(Factura::class,'obra_social_id','id');
    }
    public function gestiones(){
        return $this->hasMany(Gestion::class,'obra_social_id','id');
    }
    public function getTotalDeudaAttribute(){
        $total = Factura::where('obra_social_id', $this->id )->sum('debe');
        return $total;
    }
}
