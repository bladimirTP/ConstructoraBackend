<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('user', 'User\UserController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
Route::resource('servicio', 'Servicio\ServicioController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
Route::resource('categoria', 'Categoria\CategoriaController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
Route::resource('pago', 'Pago\PagoController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
Route::resource('obra', 'Obra\ManodeobraController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
Route::resource('detalle', 'Obra\DetalleObraController', ['only' => ['show']]);
Route::resource('personal', 'Personal\PersonalController', ['only' => ['index']]);
Route::resource('prueba', 'Prueba\PruebaController', ['only' => ['index', 'store', 'update']]);
Route::resource('postulante', 'Prueba\PostulanteController', ['only' => ['index']]);
