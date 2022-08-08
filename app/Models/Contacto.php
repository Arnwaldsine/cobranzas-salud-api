<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;
    public function gestiones(){
        return $this->hasMany(Gestion::class,'contacto-id','id');
    }
}
