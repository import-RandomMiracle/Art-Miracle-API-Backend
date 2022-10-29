<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ArtworkUserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $artworks = DB::table('artwork_user')->insert([
        //     'artwork_id'    => $request->artwork_id,
        //     'user_id'       => $request->user_id,
        // ]);

        $user = User::findOrFail($request->user_id);
        $user->artworks()->attach($request->artwork_id);

        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artworks = User::findOrFail($id);
        return $artworks;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artworks = DB::table('artwork_user')->where($id)->delete();
        return $artworks;
    }
}
