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
            'artwork_id' => 'required|exists:artworks,id'
        ]);

        $artwork = Artwork::find($request->artwork_id);
        $user = auth('api')->user();

        if ($user->wallet->balance >= $artwork->price) {
            $user->wallet->balance -= $artwork->price;
            $user->wallet->point   += $artwork->point;
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
        } else {
            return response()->json([
                'message' => 'Not enough money in your wallet',
            ], 400);
        }
    }

    public function giftArtwork(Request $request)
    {
        $request->validate([
            'artwork_id' => 'required|exists:artworks,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $request->validate([
            'artwork_id' => 'required|exists:artworks,id'
        ]);

        $artwork = Artwork::find($request->artwork_id);
        $user = auth('api')->user();
        $gift_to_user = User::find($request->user_id);
        if ($user->wallet->balance >= $artwork->price) {
            $user->wallet->balance -= $artwork->price;
            $user->wallet->point   += $artwork->point;
            $user->wallet->save();
            $artwork->user->wallet->balance += $artwork->price;
            $artwork->user->wallet->save();

            $gift_to_user->artworks()->attach($artwork->id, $gift_to_user);

            return response()->json([
                'message' => 'Artwork bought successfully',
                'artwork' => $artwork,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not enough money in your wallet',
            ], 400);
        }
    }
}
