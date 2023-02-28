<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/registration',[AuthController::class,'Register'])->name('registration');
Route::post('/login',[AuthController::class,'login'])->name('login');

