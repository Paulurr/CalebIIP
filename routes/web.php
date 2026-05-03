<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;





Route::middleware(['guest'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });    
    Route::get('/log_in', function () {
        return view('log_in');
    });     
    Route::get('/sign_up', function () {
        return view('sign_up');
    });    
    
    Route::post('log_in', [UserController::class, 'log_in']);
    Route::post('sign_up', [UserController::class, 'sign_up']);
});


Route::middleware(['auth'])->group(function () {

    Route::get('log_out', [UserController::class, 'log_out']);
    Route::get('profile', [UserController::class, 'profile']);

});


Route::middleware(['admin'])->group(function () {
    Route::get('admin', [UserController::class, 'admin']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
});

Route::middleware(['moderator'])->group(function () {
    Route::get('admin', [UserController::class, 'admin']);
    Route::put('/post/{id}', [PostController::class, 'update']);
    Route::delete('/post/{id}', [PostController::class, 'delete']);
});




Route::get('/post', [PostController::class , 'index']);
Route::post('/post', [PostController::class , 'store']);
Route::delete('/post/{id}', [PostController::class , 'delete']);
