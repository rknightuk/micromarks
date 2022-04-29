<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Controllers\IndieAuthController::class . '@showLogin');
Route::post('/login', \App\Http\Controllers\IndieAuthController::class . '@login');
Route::get('/redirect', \App\Http\Controllers\IndieAuthController::class . '@redirect');
Route::get('/logout', \App\Http\Controllers\IndieAuthController::class . '@logout');

Route::get('/bookmarks', \App\Http\Controllers\MicroPubController::class . '@bookmarks');
Route::post('/bookmarks', \App\Http\Controllers\MicroPubController::class . '@createBookmark');
Route::delete('/bookmarks/{id}', \App\Http\Controllers\MicroPubController::class . '@deleteBookmark');
Route::post('/posts', \App\Http\Controllers\MicroPubController::class . '@createPost');
