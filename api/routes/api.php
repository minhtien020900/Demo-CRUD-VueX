<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CategoryController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/categories', [CategoryController::class,'createCategory']);
Route::post('/categories/{id}', [CategoryController::class,'updateCategory']);
Route::delete('/categories/{id}', [CategoryController::class,'deleteCategory']);
Route::get('/categories', [CategoryController::class,'readCategories']);
