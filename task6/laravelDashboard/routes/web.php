<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
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

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard','middleware'=>'verified'], function () {
    Route::get('/', DashboardController::class);
    Route::group(['prefix' => 'products', 'as' => '.products.','controller'=>ProductController::class], function () {
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::put('/update/{id}','update')->name('update');
        Route::delete('/destroy/{id}','destroy')->name('destroy');
        Route::patch('/status/toggle/{id}','statusToggle')->name('toggle');
    });
});


// Route::prefix('dashboard')->group(function(){
//     Auth::routes(['verify' => true,'register' => false]);
// });    


