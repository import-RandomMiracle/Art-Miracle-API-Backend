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

    public function index()
    {
        $artworks = Artwork::with('likes',
            'image:id,resize_path',
            'comments:id,artwork_id,description',
            'category',
            'tags:id,tag_name')->get();
        return ArtworkResource::collection($artworks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artwork = Artwork::create([
            'artist_id' => $request->artist_id,
            'art_name' => $request->art_name,
            'path' => $request->path,
            'price' => $request->price,
            'description' => $request->description,
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
     * @param \App\Models\Artwork $artwork
     * @return \Illuminate\Http\Response
     */
    public function show(Artwork $artwork)
    {
        return $artwork;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Artwork $artwork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artwork $artwork)
    {
        $artwork->price = $request->price;
        $artwork->description = $request->description;

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
     * @param \App\Models\Artwork $artwork
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artwork $artwork)
    {
        $artwork->delete();

        return $artwork;
    }

//    public function index(){
//        $artworks = Artwork::with('likes',
//            'image:id,resize_path',
//            'comments:id,artwork_id,description',
//            'categories:id,category_name',
//            'tags:id,tag_name')->get();
//        return ArtworkResource::collection($artworks);
//    }

    public function artworkForSell()
    {
        $artist_id = auth('api')->user()->artist_id;
        $artworks = $this->getArtworkByID($artist_id)->
        where('price', '>', 0)->
        get();
        return ArtworkResource::collection($artworks);
    }

    public function artworkImage()
    {
        $artworks = auth('api')->user()->artworks()->
        with('likes',
            'image:id,resize_path',
            'comments:id,artwork_id,description',
            'category',
            'tags:id,tag_name')->
        where('category_id', '=', 1)->get();
        return ArtworkResource::collection($artworks);
    }

    public function artworkModel()
    {
        $artworks = auth('api')->user()->artworks()->
        with('likes',
            'image:id,resize_path',
            'comments:id,artwork_id,description',
            'category',
            'tags:id,tag_name')->
        where('category_id', '=', 2)->get();
        return ArtworkResource::collection($artworks);
    }

    public function mostLikes(int $num = 4)
    {
        $artworks = Artwork::join('images', 'artworks.image_id', '=', 'images.id')
            ->join('likes', 'artworks.id', '=', 'likes.artwork_id')
            ->selectRaw('artworks.*, images.resize_path, COUNT(likes.user_id) AS likeCount')
            ->groupBy('artworks.id')
            ->orderBy('likeCount', 'DESC')
            ->limit($num)
            ->get();

        return response(['data' => $artworks], 200, ['Content-Type' => 'application/json']);
    }

    private function getArtworkByID($id)
    {
        $artworks = Artwork::with('likes',
            'image:id,resize_path',
            'comments:id,artwork_id,description',
            'category',
            'tags:id,tag_name')
            ->where('artist_id', "=", $id);
        return $artworks;
    }
}
