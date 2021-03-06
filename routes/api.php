<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DataGeneratorController;

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


Route::post('/generate/{startFrom}', [DataGeneratorController::class, 'data']);
Route::get('/count', [DataGeneratorController::class, 'count']);
Route::get('/last', [DataGeneratorController::class, 'last']);
Route::get('/ngork-data', [DataGeneratorController::class, 'ngork_data']);
