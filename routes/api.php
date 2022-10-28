<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\ArtworkController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SelectArtworkController;

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

Route::get('/artworks/page/{pageNumber}', [SelectArtworkController::class, 'index']);

Route::apiResources([
    'artists'       => ArtistController::class,
    'artworks'      => ArtworkController::class,
    'categories'    => CategoryController::class,
    'users'         => UserController::class,
    'tags'          => TagController::class,
    'reports'       => ReportController::class,
    'likes'         => LikeController::class,
]);
