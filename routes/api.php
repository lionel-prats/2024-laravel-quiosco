<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

// ruta default de Laravel a /api/user, comentada en el v323, reemplazada por el codigo de abajo
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// este grupo de rutas de mi API requieren un token de autenticacion en los headers de la peticion para responder correctamente vvv (v323) 
// headers: { ..., Authorization: "Bearer 55|JgmpIeqrdMd...", ... } (v323)
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, "logout"]); // v323
});

// esta linea crea todos los endpoints necesarios de mi API para el recurso (resource) categorias (v298)
Route::apiResource('/categorias', CategoriaController::class);

// // esta linea crea todos los endpoints necesarios de mi API para el recurso (resource) productos (v305)
Route::apiResource('/productos', ProductoController::class);

// autenticacion 
Route::post('/registro', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]); // v315