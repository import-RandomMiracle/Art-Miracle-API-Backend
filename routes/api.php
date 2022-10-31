<?php

use App\Http\Controllers\Api\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\ArtworkController;
use App\Http\Controllers\Api\ArtworkUserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\SelectArtworkController;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::get('/artworks/page/{pageNumber}', [SelectArtworkController::class, 'index']);
Route::post('upload',[ImageController::class,'store']);
Route::get('download', [ImageController::class, 'download']);
Route::delete('delete',[ImageController::class, 'delete']);

Route::controller(ImageController::class)->group(function (){
    Route::post('upload','store');
    Route::get('download', 'download');
    Route::delete('delete', 'delete');
});
Route::apiResources([
    'artists'       => ArtistController::class,
    'artworks'      => ArtworkController::class,
    'categories'    => CategoryController::class,
    'users'         => UserController::class,
    'tags'          => TagController::class,
    'reports'       => ReportController::class,
    'likes'         => LikeController::class,
    'comments'      => CommentController::class,
    // 'user/artwork'  => ArtworkUserController::class,
]);

