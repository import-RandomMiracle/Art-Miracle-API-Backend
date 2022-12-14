<?php

use App\Http\Controllers\api\BuyController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\ArtworkController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\WalletController;

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

// Route::get('/artworks/page/{pageNumber}', [SelectArtworkController::class, 'index']);

Route::controller(ImageController::class)->group(function (){
    Route::post('image/upload','store');
    Route::get('image/download', 'download');
    Route::get('image/show/{image}','show');
    Route::delete('image/destroy/{image}', 'destroy');
});

Route::controller(ArtworkController::class)->group(function (){
    Route::get('artworks/artwork-for-sell','artworkForSell');
    Route::get('artworks/categories/image','artworkImage');
    Route::get('artworks/categories/model','artworkModel');
    Route::get('my/artworks','getMyArtwork');
    Route::get('artworks/user/{id}','getArtworkByUserID');
});

Route::controller(ArtistController::class)->group(function (){
    Route::get('artists/{artist}/artworks','artworkOfArtist');
});

Route::get('check/roll',function () {
   return new UserResource(auth('api')->user());
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
    'wallets'       => WalletController::class,
    'feedbacks'     => FeedbackController::class
    // 'user/artwork'  => ArtworkUserController::class,
]);

Route::post('buy/artwork', [BuyController::class, 'buyArtwork']);
Route::post('gift/artwork',[BuyController::class,'giftArtwork']);

Route::get('user/current', [UserController::class,'getCurrentUser']);

Route::get('artist/most/{num?}', [ArtistController::class, 'mostFollowee'])->where('num', '[0-9]+');
Route::get('artwork/most/{num?}', [ArtworkController::class, 'mostLikes'])->where('num', '[0-9]+');
