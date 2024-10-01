<?php

use App\Http\Controllers\CitizenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/users', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);

Route::middleware(\App\Http\Middleware\ApiAuthMiddleware::class)->group(function () {
    Route::get('/users/current', [UserController::class, 'get']);
    Route::patch('/users/current', [UserController::class, 'update']);
    Route::delete('/users/logout', [UserController::class, 'logout']);

    Route::get('/citizens', [CitizenController::class, 'search']);
    Route::post('/citizens', [CitizenController::class, 'store']);
});

Route::get('/provinces', function () {
    $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');

    return $response->json();
});
Route::get('/regencies', function () {
    $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/regencies.json');

    return $response->json();
});
Route::get('/districts', function () {
    $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/districts.json');

    return $response->json();
});
