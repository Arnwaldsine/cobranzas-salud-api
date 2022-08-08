<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotaCreditoRequest;
use App\Models\Factura;
use App\Models\NotaCredito;
use App\Models\ObraSocial;
use Illuminate\Http\Request;

class NotaCreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $notas = NotaCredito::with('puntoVenta','facturas');
            return response()->json([
                'status'=>true,
                'notas_credito'=>$notas
            ],200);
        }
        catch(\Throwable $th){
            return response()->json([
                        'status'=>false,
                        'message'=> $th->getMessage()
            ],  500);
         }
    }
    /**
     * @param $obraSocialId
     * @return \Illuminate\Http\Response
     */
    public function porObraSocial($obraSocialId){
     // ObraSocial::with('facturas')->find(1)->facturas[0];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotaCreditoRequest $request)
    {
        try{
            if(!$request->montosValidos()){
                return response()->json([
                    'status'=>false,
                    'message'=>'La nota que intenta crear contiene montos inválidos. Revíselos.'
                ]);
            }
            $nota = new NotaCredito();
            $nota->total = 0;
            $nota->observaciones= $request->observaciones;
            $nota->punto_venta_id = $request->user()->punto_venta_id;
            $nota->created_at= now();
            $nota->fecha_emision = now();
            $nota->updated_at=now();
            $nota->save();
            foreach($request->facturas as $factura){
                $nota->facturas()->attach($factura['factura_id'],[
                    'factura_id'=>$factura['factura_id'],
                    'nota_credito_id'=>$nota->id,
                    'subtotal'=>$factura['subtotal'],
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ]);
        /*    $aCobrar = Factura::find($factura['factura_id']);
            if($factura['subtotal'] == $aCobrar->importe){
                $aCobrar->estado_id = 4;
            }else{
                $aCobrar->importe -= $factura['subtotal'];
                $aCobrar->estado_id = 9;
            }
            $aCobrar->save();*/
            }
            $total = $nota->facturas->sum('pivot.subtotal');
            $nota->update(['total'=>$total]);
            return response()->json([
                'status'=>true,
                'message'=>'Nota creada  correctamente!'
            ],201);

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
     * @param  \App\Models\NotaCredito  $notaCredito
     * @return \Illuminate\Http\Response
     */
    public function show($notaCreditoId)
    {
       try{
        $nota = NotaCredito::with('facturas','puntoVenta')->find($notaCreditoId);
        if(is_null($nota)){
            return response()->json([
                'status'=>false,
                'message'=>'Nota de Credito no encontrada'
            ],404);
        }
        return response()->json([
            'status'=>true,
            'nota_credito'=>$nota,
        ],200);
       } catch(\Throwable $th){
        return response()->json([
            'status'=>false,
            'message'=> $th->getMessage()
        ],  500);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotaCredito  $notaCredito
     * @return \Illuminate\Http\Response
     */
    public function anular($notaCreditoId)
    {
        if(is_null($nota = NotaCredito::find($notaCreditoId))){
            return response()->json([
                'status'=>false,
                'message'=>'La nota a anular no existe.'
            ],404);
        }
        $nota->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Nota anulada'
        ],204);
    }
}
