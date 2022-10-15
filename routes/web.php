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

Route::view('/{any}', 'home')->middleware(['auth'])->where('any', '.*');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('measurementUnits', App\Http\Controllers\MeasurementUnitController::class);


Route::resource('ingredients', App\Http\Controllers\IngredientController::class);


Route::resource('recipes', App\Http\Controllers\RecipeController::class);


Route::resource('customers', App\Http\Controllers\CustomerController::class);


Route::resource('incomes', App\Http\Controllers\IncomeController::class);


Route::resource('losses', App\Http\Controllers\LossController::class);


Route::resource('productions', App\Http\Controllers\ProductionController::class);
