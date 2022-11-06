<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\User;


class BuyController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function buy(Request $request)
    {
        $request->validate([
            'artwork_id' => 'required|exists:artworks,id',
            'user_id' => 'required|exists:users,id',
            'price' => 'required|numeric',
        ]);

        $artwork = Artwork::find($request->artwork_id);
        $user = User::find($request->user_id);

        if($user->wallet->balance >= $request->price){
            $user->wallet->balance -= $request->price;
            $user->wallet->save();
            $artwork->user->wallet->balance += $request->price;
            $artwork->user->wallet->save();
            // $artwork->sold = true;
            // $artwork->save();
            $user->artworks()->attach($artwork->id, $user->id);

            return response()->json([
                'message' => 'Artwork bought successfully',
                'artwork' => $artwork,
                'user' => $user,
            ], 200);
        }else{
            return response()->json([
                'message' => 'Not enough money in your wallet',
            ], 400);
        }
    }
}
