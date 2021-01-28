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

Route::get('/', [App\Http\Controllers\PeoplesController::class, 'index'])
    ->name('peopleList');

Route::resource('/people', App\Http\Controllers\PeoplesController::class);

Route::get('/photo/{people_id}', [App\Http\Controllers\PeoplesController::class, 'showPhoto'])
    ->name('photoList');
Route::post('/photo/{people_id}', [App\Http\Controllers\PhotoController::class, 'update'])
    ->name('photoUpdate');
Route::post('/photo/{people_id}/delete', [App\Http\Controllers\PhotoController::class, 'destroy'])
    ->name('photoDelete');

Route::get('/homeworld/{homeworld_id}', [App\Http\Controllers\HomeworldControler::class, 'show'])->name('homeworldId');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
