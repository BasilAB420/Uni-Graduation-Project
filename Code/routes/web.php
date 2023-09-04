<?php

use App\Http\Controllers\allGoodsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UniversitiesController;
use Illuminate\Support\Facades\Route;

Route::resource('/', HomeController::class);
Route::resource('/allgoods', allGoodsController::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('universities', UniversitiesController::class);
    Route::resource('goods', GoodsController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




    Route::post('goods/update', 'GoodsController@update')->name('goods.update');

    Route::get('goods/destroy/{id}', 'GoodsController@destroy');
});

require __DIR__ . '/auth.php';
