<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ObraSocial;
use Illuminate\Http\Request;

class ObraSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $obras_sociales = ObraSocial::orderBy('nombre')->get();
            return response()->json([
                'status'=>true,
                'obras_sociales'=>$obras_sociales,
            ],200);
        }catch(\Throwable $th){
             return response()->json([
                'status'=>false,
                'message'=> $th->getMessage()
            ],  500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ObraSocial  $obraSocial
     * @return \Illuminate\Http\Response
     */
    public function show(ObraSocial $obraSocial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObraSocial  $obraSocial
     * @return \Illuminate\Http\Response
     */
    public function edit(ObraSocial $obraSocial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObraSocial  $obraSocial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ObraSocial $obraSocial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObraSocial  $obraSocial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObraSocial $obraSocial)
    {
        //
    }
}
