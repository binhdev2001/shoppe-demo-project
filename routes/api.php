<?php

use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\BrandsController;
use App\Http\Controllers\Api\CategoriesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('/products', ProductsController::class );
Route::apiResource('/brands', BrandsController::class );
Route::apiResource('/categories', CategoriesController::class );