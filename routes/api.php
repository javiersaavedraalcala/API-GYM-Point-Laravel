<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Mail\WelcomeClientMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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


Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('clients', ClientController::class);
});


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('test', function() {
    Mail::send(new WelcomeClientMail(
        'a@s.com',
        'Robert',
        '2024-04-01',
        '2025-04-01',
        'anually'
    ));

    return "success";
});