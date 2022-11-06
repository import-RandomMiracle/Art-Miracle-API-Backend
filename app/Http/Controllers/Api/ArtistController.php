<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use App\Http\Resources\ArtworkResource;
use App\Http\Resources\UserResource;
use App\Models\Artist;
use App\Models\User;
use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::get();
        return ArtistResource::collection($artists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artist = Artist::create([
            'citizen_id' => $request->citizen_id,
            'real_name' => $request->real_name,
            'address' => $request->address
        ]);

        return $artist;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        return $artist;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        return "method not allowed.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Artist $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return $artist;
    }

    public function mostFollowee(int $num = 4) {
        $users = User::join('artists', 'artist_id', '=', 'artists.id')
        ->join('follows', 'artists.id', '=', 'follows.follower_id')
        ->selectRaw('users.*, artists.*, COUNT(follows.followee_id) AS followers')
        ->groupBy('users.id')
        ->orderBy('followers', 'DESC')
        ->limit($num)
        ->get();

        return response(['data' => $users], 200, ['Content-Type' => 'application/json']);
    }

    public function artworkOfArtist(Artist $artist)
    {
        $artworks = Artwork::with('likes',
            'image:id,resize_path',
            'comments:id,artwork_id,description',
            'categories:id,category_name',
            'tags:id,tag_name')->where('artist_id',"=",$artist->id)->get();
        return ArtworkResource::collection($artworks);
    }
}
