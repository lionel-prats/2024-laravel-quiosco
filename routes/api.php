<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// esta linea crea todos los endpoints necesarios de mi API para el recurso (resource) categorias (v298)
Route::apiResource('/categorias', CategoriaController::class);

// esta linea crea todos los endpoints necesarios de mi API para el recurso (resource) productos (v305)
Route::apiResource('/productos', ProductoController::class);
