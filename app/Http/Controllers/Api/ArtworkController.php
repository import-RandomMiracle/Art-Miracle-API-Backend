<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArtworkResource;
use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ArtworkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        $artworks = Artwork::with('likes',
            'image:id,resize_path',
            'comments:id,artwork_id,description',
            'categories:id,category_name',
            'tags:id,tag_name')->get();
        return ArtworkResource::collection($artworks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'artist_id' => 'required|integer',
            'art_name' => 'required|unique:artworks,art_name',
            'path' => 'required|unique:artworks,path',
            'price' => 'required|numeric',
            'description' => 'required|max:1024',
        ])
        $artwork = Artwork::create([
            'artist_id'     => $request->artist_id,
            'art_name'      => $request->art_name,
            'path'          => $request->path,
            'price'         => $request->price,
            'description'   => $request->description,
        ]);

        $artwork->categories()->attach($request->categories);

        foreach ($request->tags as $tag) {
            $artwork->tags()->attach($tag);
        }

        return $artwork;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artwork  $artwork
     * @return \Illuminate\Http\Response
     */
    public function show(Artwork $artwork)
    {
        return $artwork;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artwork  $artwork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artwork $artwork)
    {
        $request->validate([
            'price' => 'required|numeric',
            'description' => 'required',
            'categories' => 'required',
        ])
        $artwork->price         = $request->price;
        $artwork->description   = $request->description;

        $artwork->categories()->detach($artwork->categories);
        $artwork->categories()->attach($request->categories);

        foreach ($artwork->tags as $tag) {
            $artwork->tags()->detach($tag);
        }

        foreach ($request->tags as $tag) {
            $artwork->tags()->attach($tag);
        }

        return $artwork;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artwork  $artwork
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artwork $artwork)
    {
        $artwork->delete();

        return $artwork;
    }
}
