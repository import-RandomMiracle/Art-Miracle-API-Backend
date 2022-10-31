<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;

class LikeController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $like = new Like();
        $like->user_id = $request->user_id;
        $like->artwork_id = $request->artwork_id;
        $like->liked = True;
        $like->save();

        return $like;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request->liked == 'true'){
            $like = Like::where('user_id', $request->user_id)->where('artwork_id', $request->artwork_id)->first();
            $like->liked = False;
            $like->save();
            return $like;
        } else {
            $like = Like::where('user_id', $request->user_id)->where('artwork_id', $request->artwork_id)->first();
            $like->liked = True;
            $like->save();
            return $like;
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $like = Like::withTrashed()->find($id)->restore();

        return $like;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        // Artwork::user()->likes()->where('artwork_id', $id)->first()->delete();
        $like->delete();
    }
}
