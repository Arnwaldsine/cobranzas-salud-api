<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReciboRequest;
use App\Models\Factura;
use App\Models\Recibo;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class ReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $recibos = Recibo::with('facturas')->orderBy('created_at')->get();
            return response()->json([
                'status'=>true,
                'recibos'=>$recibos,
            ],200);
        }catch(\Throwable $th){
             return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreReciboRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReciboRequest $request)
    {
        try{
            if(!($request->montosValidos($request->facturas))){
                return response()->json([
                    'status'=>false,
                    'message'=>'El recibo que intenta crear contiene montos inválidos. Revíselos.'
                ]);
            }else{


                $reciboCreado = new Recibo();
                $reciboCreado->total = 0;
                $reciboCreado->observaciones = $request->observaciones;
                $reciboCreado->punto_venta_id = $request->user()->punto_venta_id;
                $reciboCreado->save();


                foreach($request->facturas as $factura){
                    $reciboCreado->facturas()->attach($factura['factura_id'],[
                        'forma_pago_id'=>$factura['forma_pago_id'],
                        'recibo_id'=>$reciboCreado->id,
                        'nro_cheque_transf'=>$factura['nro_cheque_transf'],
                        'nro_recibo_tesoreria'=>$factura['nro_recibo_tesoreria'],
                        'banco_id'=>$factura['banco_id'],
                        'subtotal'=>$factura['subtotal']
                    ]);
                    $aCobrar = Factura::find($factura['factura_id']);
                    $aCobrar->cobrado += $factura['subtotal'];
                    $aCobrar->fecha_ultimo_pago = now();
                    $aCobrar->setEstado();
                    $aCobrar->save();
                }
                $total = $reciboCreado->facturas->sum('pivot.subtotal');
                $reciboCreado->update(['total'=>$total]);
                return response()->json([
                    'status'=>true,
                    'message'=>'Recibo creado correctamente!'
                ],201);
            }
        }
        catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function show($reciboId)
    {
        try{
            $recibo = Recibo::with('facturas')->find($reciboId);
            if(is_null($recibo)){
                return response()->json([
                    'status'=>false,
                    'message'=>'Recibo no encontrado',
                ],404);
            }
            return response()->json([
                'status'=>true,
                'recibo'=>$recibo
            ],200);

        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }
    }
}
