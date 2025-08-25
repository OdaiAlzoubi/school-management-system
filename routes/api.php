<?php

use App\Enum\RoleEnum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\School\StudentController;


Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum', 'role.permission:' . RoleEnum::ADMINISTRATOR->value], 'prefix' => 'student'], function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::post('/create', [StudentController::class, 'store']);
    Route::put('/update/{id}', [StudentController::class, 'update']);
    Route::get('/show/{id}', [StudentController::class, 'show']);
    Route::delete('/delete/{id}', [StudentController::class, 'destroy']);
});
