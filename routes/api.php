<?php

use App\Http\Controllers\ArduinoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/arduino/button',       [ArduinoController::class, 'getButtonRequest']);
Route::get('/arduino/presure',      [ArduinoController::class, 'getPresureValue']);
Route::get('/arduino/test', function(){
     return "#OK";
});
