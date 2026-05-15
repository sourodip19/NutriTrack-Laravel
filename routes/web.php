<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\LogsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',
    [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/logs',[LogsController::class, 'index'])->name('logs');
});


    Route::middleware('auth')->group(function () {

    Route::get('/food-search',
        [FoodController::class, 'index'])
        ->name('food.search');

    Route::post('/food-search',
        [FoodController::class, 'search']);
});

Route::post('/meals',
    [MealController::class, 'store']);

    Route::post('/weight-log',
    [WeightController::class, 'store']);

    Route::post(
    '/manual-meal',

    [MealController::class, 'store']
);
require __DIR__.'/auth.php';
