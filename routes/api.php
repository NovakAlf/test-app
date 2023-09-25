<?php

use Illuminate\Http\Request;
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
Route::prefix('auth')
  ->namespace('App\Http\Controllers')
  ->group(function () {
  Route::post('register', 'AuthController@register');
  Route::post('login', 'AuthController@login');
  Route::get('logout', 'AuthController@logout')->middleware('auth:sanctum');
  Route::get('user', 'AuthController@getUser')->middleware('auth:sanctum');
});

Route::prefix('events')
  ->namespace('App\Http\Controllers')
  ->middleware('auth:sanctum')
  ->group(function () {
    Route::get('events', 'EventController@events');
    Route::get('users', 'EventController@users');
    Route::post('create', 'EventController@create');
    Route::post('remove', 'EventController@remove');
    Route::post('toggle', 'EventController@toggle');
  });

