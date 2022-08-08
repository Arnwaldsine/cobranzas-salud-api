<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FacturaDebito extends Pivot
{
    protected $fillable= array('factura_id','nota_debito_id','subtotal');

}
