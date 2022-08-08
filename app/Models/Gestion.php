<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    protected $table = 'gestiones';
    protected $fillable = array('obra_social_id','contacto_id','fecha_contacto','respuesta_id','fecha_proximo_contacto','user_id','observaciones');
    use HasFactory;
    public function respuesta(){
        return $this->belongsTo(Repuesta::class,'respuesta_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function contacto(){
        return $this->belongsTo(Contacto::class,'contacto_id','id');
    }
    public function obraSocial(){
        return $this->belongsTo(ObraSocial::class,'obra_social_id','id');
    }
}
