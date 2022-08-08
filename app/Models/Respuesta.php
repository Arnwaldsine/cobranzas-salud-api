<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    public function gestiones(){
        return $this->hasMany(Gestion::class,'respuesta_id','id');
    }
}
