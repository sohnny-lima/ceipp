<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Landing - sin login)
|--------------------------------------------------------------------------
| Estas rutas NO requieren autenticación.
|--------------------------------------------------------------------------
*/
Route::get('/public/users/tables', [UserController::class, 'tablesPublic']);
Route::get('/public/users/search/{dni}', [UserController::class, 'searchByDniPublic']);
Route::post('/public/users/save', [UserController::class, 'savePublic']); // ✅ NUEVO