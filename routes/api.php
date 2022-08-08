<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BancoController;
use App\Http\Controllers\Api\ContactoController;
use App\Http\Controllers\Api\EstadoController;
use App\Http\Controllers\Api\FacturaController;
use App\Http\Controllers\Api\FormaPagoController;
use App\Http\Controllers\Api\GestionController;
use App\Http\Controllers\Api\NotaCreditoController;
use App\Http\Controllers\Api\ObraSocialController;
use App\Http\Controllers\Api\PuntoVentaController;
use App\Http\Controllers\Api\ReciboController;
use App\Http\Controllers\Api\RespuestaController;
use App\Models\FormaPago;
use App\Models\NotaCredito;
use App\Models\TipoPrestador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('/auth/register',[AuthController::class,'createUser'])->name('register');
Route::post('/auth/loginUser',[AuthController::class,'loginUser'])->name('login');
Route::post('logout',[AuthController::class,'logout']);
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user',function(Request $request){
        return $request->user();
    });
    Route::get('/estados',[EstadoController::class,'index']);
    Route::get('/facturas',[FacturaController::class,'index']);
    Route::get('/facturas/{facturaId:int}',[FacturaController::class,'show']);
    Route::get('/facturas/obra-social/{obraSocialId:int}',[FacturaController::class,'porObraSocial']);
    Route::post('/facturas',[FacturaController::class,'store']);

    Route::get('/puntos-venta',[PuntoVentaController::class,'index']);

    Route::get('/obras-sociales',[ObraSocialController::class,'index']);

    Route::get('/contactos',[ContactoController::class,'index']);

    Route::get('/bancos',[BancoController::class,'index']);

    Route::get('/respuestas',[RespuestaController::class,'index']);

    Route::get('tipos-prestador',[TipoPrestador::class,'index']);

    Route::get('/formas-pago',[FormaPagoController::class,'index']);

    Route::get('/recibos',[ReciboController::class,'index']);
    Route::get('/recibos/{reciboId}',[ReciboController::class,'show']);
    Route::post('/recibos',[ReciboController::class,'store']);

    Route::get('/gestiones/{gestionId:int}',[GestionController::class,'show']);
    Route::get('/gestiones',[GestionController::class,'index']);
    Route::delete('/gestiones/{gestionId:int}',[GestionController::class,'destroy']);
    Route::post('/gestiones',[GestionController::class,'store']);
    Route::put('/gestiones/{gestionId:int}',[GestionController::class,'update']);
    Route::get('/gestiones/obra-social/{obraSocialId:int}',[GestionController::class,'porObraSocial']);

    Route::get('/notas-credito',[NotaCreditoController::class,'index']);
    Route::get('/notas-credito/{notaCreditoId:int}',[NotaCreditoController::class,'show']);
    Route::post('/notas-credito',[NotaCreditoController::class,'store']);
    Route::get('/notas-credito/obra-social/{obraSocialId:int}',[NotaCreditoController::class,'porObraSocial']);
    Route::delete('/notas-credito/{notaCreditoId}',[NotaCreditoController::class,'anular']);

    Route::get('/notas-debito',[NotaDebitoController::class,'index']);
    Route::get('/notas-debito/{notadebitoId:int}',[NotaDebitoController::class,'show']);
    Route::post('/notas-debito',[NotaDebitoController::class,'store']);
    Route::get('/notas-debito/obra-social/{obraSocialId:int}',[NotaDebitoController::class,'porObraSocial']);
    Route::delete('/notas-debito/{notadebitoId}',[NotaDebitoController::class,'anular']);


});
