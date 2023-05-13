<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProductAssetController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Category
Route::apiResource('category',CategorieController::class);
Route::get('categoryByJumlahProduct',[CategorieController::class,'sortByJumlahProduct']);

// Product
Route::apiResource('product',ProductController::class);
Route::get('productByPrice',[ProductController::class,'sortByPrice']);

// Product Asset
Route::apiResource('product_asset',ProductAssetController::class);
Route::delete('product_asset/{id}/{type}',[ProductAssetController::class,'destroy']);


