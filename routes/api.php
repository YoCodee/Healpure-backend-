<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
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

Route::middleware('auth:sanctum')->group( function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/create', [FormController::class, 'createForm']);
    Route::post('/delete/{id}', [FormController::class, 'delete']);
    Route::get('/get/{id}', [FormController::class, 'get']);
});

Route::post('/v1/auth/register', [AuthController::class, 'register']);
Route::post('/v1/auth/login', [AuthController::class, 'login']);

