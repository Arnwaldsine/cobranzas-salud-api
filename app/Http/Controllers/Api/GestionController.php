<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGestionRequest;
use App\Http\Requests\UpdateGestionRequest;
use App\Models\Gestion;
use App\Models\ObraSocial;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RequestStack;

use function PHPUnit\Framework\isNull;

class GestionController extends Controller
{
    /**
     * Registro global de gestiones
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $gestiones = Gestion::with('obraSocial')->orderby('created_at')->paginate(12);
            return response()->json([
                'status'=>true,
                'gestiones'=>$gestiones,
            ],  200);
        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }
    }
    public function porObraSocial($obraSocialId){
        try{
            $obraSocial = ObraSocial::with('tipoPrestador')->findOrFail($obraSocialId);
            $gestiones = Gestion::where('obra_social_id',$obraSocialId)->orderby('fecha_contacto')->paginate(12);
            return response()->json([
                'status'=>true,
                'obraSocial'=>$obraSocial,
                'gestiones'=>$gestiones,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGestionRequest $request)
    {
        try{
            $request->request->add([
                'obra_social_id'=>$request->obra_social_id,
                'contacto_id'=>$request->contacto_id,
                'fecha_contacto'=>now(),
                'respuesta_id'=>$request->respuesta_id,
                'fecha_proximo_contacto'=>$request->fecha_proximo_contacto,
                'user_id'=>$request->user()->id,
                'observaciones'=>$request->observaciones,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            Gestion::create($request->all());
            return response()->json([
                'status'=>true,
                'message'=>'Gestion añadida correctamente'
            ],201);
        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function show($gestionId)
    {
        try{

            $gestion = Gestion::with('obraSocial','contacto','respuesta','user:id,nombre,apellido')->find($gestionId);
            if(isNull($gestion)){
                return response()->json([
                    'status'=>false,
                    'message'=> 'Gestion no encontrada'
                ],  404);
            }
            return response()->json([
                'status'=>true,
                'gestion'=>$gestion,
            ],  200);
        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gestionId)
    {

       try{
            $gestion = Gestion::find($gestionId);
            if(is_null($gestion)){
                return response()->json([
                    'status'=>false,
                    'message'=>'La gestion no existe.',
                ], 404);
            }else{
                $gestion->update([
                    'obra_social_id'=>$request->obra_social_id,
                    'contacto_id'=>$request->contacto_id,
                    'respuesta_id'=>$request->respuesta_id,
                    'fecha_proximo_contacto'=>$request->fecha_proximo_contacto,
                    'observaciones'=>$request->observaciones,
                    'updated_at'=>now(),
                ]);
                return response()->json([
                    'status'=>true,
                    'message'=>'Gestion modificada'
                ],200);
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($gestionId)
    {
        try{
            $gestion = Gestion::findOrFail($gestionId);
            if(is_null($gestion)){
                return response()->json([
                    'status'=>false,
                    'message'=>'La gestion no existe.',
                ], 404);
            }else{
                $gestion->delete();
                return response()->json([
                    'status'=>true,
                ],204);
            }
        }catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }
    }
}
