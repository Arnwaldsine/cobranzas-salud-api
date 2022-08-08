<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NotaDebito;
use Illuminate\Http\Request;

class NotaDebitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            NotaDebito::with('facturas','puntoVenta')->paginate(12);
        } catch(\Throwable $th){
            return response()->json([
                        'status'=>false,
                        'message'=> $th->getMessage()
            ],  500);
         }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $nota = new NotaDebito();
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
     * @param  \App\Models\NotaDebito  $notaDebito
     * @return \Illuminate\Http\Response
     */
    public function show($notaDebitoId)
    {
        try{
            $nota = NotaDebito::with('facturas','puntoVenta')->find($notaDebitoId);
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
     * @param  \App\Models\NotaDebito  $notaDebito
     * @return \Illuminate\Http\Response
     */
    public function destroy($notaDebitoId)
    {
        if(is_null($nota = NotaDebito::find($notaDebitoId))){
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
