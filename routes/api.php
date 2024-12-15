<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\TomoController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('tomos')->group(function(){
    //Crear pelicula
    Route::post('',[TomoController:: class, 'create']);
    //Obtener todas las peliculas
    Route::get('',[TomoController:: class, 'TomosAll']);
    //actualizar pelicula
    Route::patch('/{id}', [TomoController::class, 'update'])->where('id','[0-9]');
    //eliminar pelicula
    Route::delete('/{id}', [TomoController::class, 'delete'])->where('id','[0-9]');
    //Obtener una pelicula
    Route::get('/{id}', [TomoController::class, 'TomoId'])->where('id','[0-9]');
    //Filtrar los tomos
    Route::get('/filter', [TomoController::class, 'filter']);
    //Buscar de acuerdo a la pregunta
    Route::get('/search', [TomoController::class, 'search']);

});

