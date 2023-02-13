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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

use App\Http\Controllers\ApiController;

// Ejemplos URL:
// - http://api-pluglin/api/v1/categorias/11 
// - http://api-pluglin/api/v1/idiomas/es 

Route::prefix('v1')->name('v1.')->group(function(){
    Route::get('/categorias', [ApiController::class, 'all_categorias'])->name('all_categorias');
    Route::get('/categorias/{categoria}', [ApiController::class, 'categoria'])->where(['categoria' => '[0-9a-z]+'])->name('categorias');

    Route::get('/idiomas', [ApiController::class, 'all_idiomas'])->name('idiomas');
    Route::get('/idiomas/{idioma}', [ApiController::class, 'idioma'])->where(['idioma' => '[0-9a-z]+'])->name('idiomas');
});

