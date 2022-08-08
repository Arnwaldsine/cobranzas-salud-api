<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FacturaNota extends Pivot
{
    protected $fillable= array('factura_id','nota_credito_id','subtotal');
    protected $table = 'factura_nota';
    use HasFactory;
}
