<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FacturaRecibo extends Pivot
{
    use HasFactory;
    protected $table = 'factura_recibo';
 //   protected $fillable = array('factura_id','recibo_id','forma_pago_id','nro_cheque_transf','nro_recibo_tesoreria','banco_id','subtotal');
    protected $fillable =  array('forma_pago_id','nro_cheque_transf','nro_recibo_tesoreria','banco_id','subtotal');
    public $incrementing = true;
}
