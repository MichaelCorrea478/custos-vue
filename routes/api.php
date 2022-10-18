<?php

use App\Http\Controllers\API\RecipeAPIController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::middleware('auth:api')->group(function() {
    Route::resource('measurement_units', App\Http\Controllers\API\MeasurementUnitAPIController::class);
    Route::resource('ingredients', App\Http\Controllers\API\IngredientAPIController::class);

    Route::resource('recipes', App\Http\Controllers\API\RecipeAPIController::class);
    Route::post('recipe_ingredient/add', [RecipeAPIController::class, 'addIngredient'])->name('recipe_ingredient.add');

    Route::resource('customers', App\Http\Controllers\API\CustomerAPIController::class);
    Route::resource('incomes', App\Http\Controllers\API\IncomeAPIController::class);
    Route::resource('losses', App\Http\Controllers\API\LossAPIController::class);
    Route::resource('productions', App\Http\Controllers\API\ProductionAPIController::class);
});
