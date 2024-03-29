<?php
use Illuminate\Support\Facades\Route;
use Modules\Articles\Http\Controllers\ArticlesController;
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

Route::prefix('api')->middleware('auth:api')->group(function() {
    Route::apiResource('/articles', ArticlesController::class);
});
