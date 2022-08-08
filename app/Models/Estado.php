<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    use HasFactory;
    public function facturas(){
        return $this->hasMany(Factura::class,'estado-id','id');
    }
}
