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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['auth']], function(){
    Route::get('/uzytkownicy', [App\Http\Controllers\UserController::class, 'show'])->name('uzytkownicy');
    //Route::get('/uzytkownicy/dodaj', [App\Http\Controllers\UserController::class, 'index']);
    
    Route::get('/aplikacje', [App\Http\Controllers\AppController::class, 'show'])->name('aplikacje');
    Route::post('/aplikacje',[App\Http\Controllers\AppController::class, 'store'])->name('aplikacje');
    
    Route::get('/aplikacje/dodaj',[App\Http\Controllers\AppController::class, 'create']);
    
    Route::get('/fanpage',[App\Http\Controllers\FanpageController::class, 'index'])->name('fanpage');
    Route::post('/fanpage',[App\Http\Controllers\FanpageController::class, 'store'])->name('fanpage');
    
    Route::get('/fanpage/dodaj',[App\Http\Controllers\FanpageController::class, 'create']);
    Route::get('/fanpage/{id}',[App\Http\Controllers\FanpageController::class, 'statystyki'])->name('statystyki');
});

