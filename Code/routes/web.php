<?php

use App\Http\Controllers\allGoodsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UniversitiesController;
use Illuminate\Support\Facades\Route;

Route::resource('/', HomeController::class);
Route::resource('/allgoods', allGoodsController::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/universities', [UniversitiesController::class, 'index']);
    Route::post('/universitiesstore', [UniversitiesController::class, 'store'])->name('universitiesstore');
    Route::get('/universitiesfetchall', [UniversitiesController::class, 'fetchAll'])->name('universitiesfetchAll');
    Route::delete('/universitiesdelete', [UniversitiesController::class, 'delete'])->name('universitiesdelete');
    Route::get('/universitiesedit', [UniversitiesController::class, 'edit'])->name('universitiesedit');
    Route::post('/universitiesupdate', [UniversitiesController::class, 'update'])->name('universitiesupdate');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/goods', [EmployeeController::class, 'index']);
    Route::post('/store', [EmployeeController::class, 'store'])->name('store');
    Route::get('/fetchall', [EmployeeController::class, 'fetchAll'])->name('fetchAll');
    Route::delete('/delete', [EmployeeController::class, 'delete'])->name('delete');
    Route::get('/edit', [EmployeeController::class, 'edit'])->name('edit');
    Route::post('/update', [EmployeeController::class, 'update'])->name('update');
});


// Route::get('/studentsdashboard', [StudentController::class, 'index']);
require __DIR__ . '/auth.php';
