<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FormaPago;
use Illuminate\Http\Request;

class FormaPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $formas_pago = FormaPago::orderBy('forma')->get();
            return response()->json([
                'status'=>true,
                'formas_pago'=>$formas_pago,
            ],200);
        }catch(\Throwable $th){
             return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }
    }
}
