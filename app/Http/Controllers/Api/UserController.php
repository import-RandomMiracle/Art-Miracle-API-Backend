<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class UserController extends Controller
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

        $users = User::with(['artist:id',
            'wallet:id,balance,point',
            'artworks:id,artist_id,image_id,art_name,price,description',
            'followers',
            'followees'])->get();
        return UserResource::collection($users);
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
            'user_name' => 'required|unique:users,user_name',
            'display_name' => 'required|min:4|max:32',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|password',
        ]);

        $wallet = Wallet::create();
        $user = User::create([
            'user_name'         => $request->user_name,
            'display_name'      => $request->display_name,
            'email'             => $request->email,
            'password'          => $request->password,
            'wallet_id'         => $wallet->id,
        ]);
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $userTemp = User::with(['artist:id',
            'wallet:id,balance,point',
            'artworks:id,artist_id,image_id,art_name,price,description',
            'followers',
            'followees'])->where('id','=',$user->id)->first();
        return new UserResource($userTemp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'display_name' => 'required|min:4|max:32',
        ]);

        $user->display_name = $request->display_name;

        if($request->hasFile('avatar')) {
            //delete old profile image
            redirect()->action(
                'ImageController@deleteImage', ['path' => $user->image]
            );

            //save new profile image
            $user->path = redirect()->action(
                'ImageController@store', ['request' => $request]
            );
        }

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return "method not allowed.";
    }

    public function getCurrentUser(){
        $user_id = auth('api')->user()->id;
        $user = User::with(['artist:id',
            'wallet:id,balance,point',
            'artworks:id,artist_id,image_id,art_name,price,description',
            'followers',
            'followees'])->where('id','=',$user_id)->first();
        return new UserResource($user);
    }
}
