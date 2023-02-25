<?php

use App\Http\Controllers\Api\Media\MediasController;
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
    Route::get('/', [MediasController::class, 'index']);
    Route::get('/top-rated', [MediasController::class, 'topRated']);
    Route::get('/{id}/detail', [MediasController::class, 'detail']);
    Route::get('/{id}/videos', [MediasController::class, 'videos']);
    Route::get('/search', [MediasController::class, 'search']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
