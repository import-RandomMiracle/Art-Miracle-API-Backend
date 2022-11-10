<?php

namespace App\Policies;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ArtistPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return Response::allow();
    
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Artist $artist)
    {
        
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if($user->role === "USER"){
            return $user->artist_id === null ?
            Response::allow() :
            Response::deny('You already have an artist profile');
        }else{
            return Response::deny('You must be a user to create an artist profile');
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Artist $artist)
    {
        if($user->role === "USER"){
            return $user->id == $artist->user_id ?
                Response::allow() :
                Response::deny("You don't have permission to view this artist profile.");
        }else{
            return Response::deny('You must be a user to update an artist profile');
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Artist $artist)
    {
        if($user->role === "ADMIN"){
            return Response::allow();
        }else{
            return $user->id == $artist->user_id ?
                Response::allow() :
                Response::deny("You don't have permission to delete this artist profile.");
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Artist $artist)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Artist $artist)
    {
        //
    }
}
