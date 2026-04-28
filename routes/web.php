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
    
    Route::post('log_in', [App\Http\Controllers\UserController::class, 'log_in']);
    Route::post('sign_up', [App\Http\Controllers\UserController::class, 'sign_up']);
});


Route::middleware(['auth'])->group(function () {

    Route::get('log_out', [App\Http\Controllers\UserController::class, 'log_out']);

});


Route::get('/post', [PostController::class , 'index']);
Route::post('/post', [PostController::class , 'store']);
Route::delete('/post/{id}', [PostController::class , 'delete']);
