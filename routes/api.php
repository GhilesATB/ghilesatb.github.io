<?php

use App\Http\Controllers\Api\Media\MoviesController;
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

/*
 * movie routes
 */
Route::prefix('/movies')->group(function () {
    Route::get('/', [MoviesController::class, 'index']);
    Route::get('/top-rated', [MoviesController::class, 'topRated']);
    Route::get('/{id}/detail', [MoviesController::class, 'detail']);
    Route::get('/{id}/videos', [MoviesController::class, 'videos']);
    Route::get('/search', [MoviesController::class, 'search']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
