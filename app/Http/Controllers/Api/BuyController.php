<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\User;


class BuyController extends Controller
{
    public function buyArtwork(Request $request)
    {
        $request->validate([
            'artwork_id' => 'required|exists:artworks,id',
            'user_id' => 'required|exists:users,id',
            'price' => 'required|numeric',
        ]);

        $artwork = Artwork::find($request->artwork_id);
        $user = User::find(auth('api')->user()->id);

        if($user->wallet->balance >= $artwork->price){
            $user->wallet->balance -= $artwork->price;
            $user->wallet->save();
            $artwork->user->wallet->balance += $artwork->price;
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
