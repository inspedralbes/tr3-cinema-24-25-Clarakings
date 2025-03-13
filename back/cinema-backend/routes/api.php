<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí se definen las rutas de la API. Todas estarán bajo el prefijo /api.
| Esto garantiza que se apliquen las configuraciones de CORS definidas en
| config/cors.php para rutas que empiecen con "api/*".
|
*/

Route::group(['prefix' => 'api'], function () {

    // Rutas públicas
    Route::get('/movies', [MoviesController::class, 'index']);
    Route::get('/movie/{id}', [MoviesController::class, 'show']);

    Route::get('/sessions', [SessionsController::class, 'index']);
    Route::get('/session/{id}', [SessionsController::class, 'show']);
    Route::get('/movie_session/{id}', [SessionsController::class, 'getByMovieId']);

    Route::get('/entradas', [EntradaController::class, 'index']);
    Route::post('/entradas', [EntradaController::class, 'create']);
    Route::get('/session/{id}/entradas', [EntradaController::class, 'showWithIdSession']);
    Route::post('/entradas/validate', [EntradaController::class, 'validateEmail']);
    Route::post('/entradas/totalPurchase', [EntradaController::class, 'showTotalPurchase']);

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Rutas protegidas (requieren autenticación con Sanctum)
    Route::group(['middleware' => ['auth:sanctum']], function () {
        // Administración
        Route::post('/addSession', [SessionsController::class,'create']);
        Route::post('/addMovie', [MoviesController::class,'create']);
        Route::post('/updateSession', [SessionsController::class,'update']);
        Route::post('/updateMovie', [MoviesController::class,'update']);
        Route::delete('/deleteSession/{id}', [SessionsController::class,'destroy']);
        Route::delete('/deleteMovie/{id}', [MoviesController::class,'destroy']);
        Route::get('/moviesFree', [MoviesController::class, 'moviesWithoutSession']);

        // Buscadores de entradas
        Route::post('/entradas/searchIdEmail', [EntradaController::class, 'showWithEmailIdSession']);
        Route::post('/entradas/searchEmail', [EntradaController::class, 'showWithEmail']);

        // Cierre de sesión
        Route::post('/logout', [AuthController::class, 'logout']);
    });

});
