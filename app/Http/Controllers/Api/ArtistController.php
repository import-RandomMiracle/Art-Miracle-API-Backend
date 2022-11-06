<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use App\Http\Resources\ArtworkResource;
use App\Models\Artist;
use App\Models\Artwork;
use Illuminate\Http\Request;

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
