<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banco;
use App\Models\Factura;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $bancos = Banco::orderBy('nombre')->get();
            return response()->json([
                'status'=>true,
                'bancos'=>$bancos,
            ],200);
        }catch(\Throwable $th){
             return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }
    }


}
