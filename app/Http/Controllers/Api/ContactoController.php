<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $contactos = Contacto::orderBy('contacto')->get();
            return response()->json([
                'status'=>true,
                'contactos'=>$contactos,
            ],200);
        }catch(\Throwable $th){
             return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }
    }
}
