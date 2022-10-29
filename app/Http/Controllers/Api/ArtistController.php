<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artist = Artist::create([
            'citizen_id'    => $request->citizen_id,
            'real_name'     => $request->real_name,
            'address'       => $request->address
        ]);

        return $artist;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        return $artist;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        return "method not allowed.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $deletingArtist = new Artist([
            'citizen_id'    => $artist->citizen_id,
            'real_name'     => $artist->real_name,
            'address'       => $artist->address,
        ]);
        $artist->delete();
        return $deletingArtist;
    }
}
