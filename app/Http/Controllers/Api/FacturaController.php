<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeFacturaRequest;
use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $facturas = Factura::latestFirst()->paginate(10);
            return response()->json([
                'status'=>true,
                'facturas'=>$facturas
            ],  200);
        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function porObraSocial($id)
    {
        try{
            $facturas = Factura::latestFirst()->where('obra_social_id',$id)->paginate(12);
            return response()->json([
                'status'=>true,
                'facturas'=>$facturas
            ],  200);
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
     * @param  \Illuminate\Http\StoreFacturaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeFacturaRequest $request)
    {
        try{
            $request->request->add([
                'punto_venta_id' => $request->user()->punto_venta_id,
                'fecha_emision' => now(),
                'fecha_ultimo_pago' =>null,
                'fecha_acuse' =>now(),
                'cobrado' => 0,
                'estado_id' =>1,
                'created_at'=>now(),
                'updated_at' =>now()
            ]);
            Factura::create($request->all());
            return response()->json([
                'status'=>true,
                'message'=>'Factura creada correctamente!',
            ], 201);
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
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $factura = Factura::with('puntoVenta','obraSocial','estado')->find($id);
            if(is_null($factura)){
                return response()->json([
                    'status'=>false,
                    'message'=> 'Factura No encontrada'
                ],404);

            }else{
                return response()->json([
                    'status'=>true,
                    'factura'=>$factura,
                ],200);
            }
        } catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }

    }
}
