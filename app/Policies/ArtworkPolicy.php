<?php

namespace App\Policies;

use App\Models\Artwork;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ArtworkPolicy
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
     * @param  \App\Models\Artwork  $artwork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Artwork $artwork)
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
            return $user->artist_id !== null ?
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
     * @param  \App\Models\Artwork  $artwork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Artwork $artwork)
    {
            if($user->role === "USER"){
            return $user->id == $artwork->artist->user_id ?
                Response::allow() :
                Response::deny("You don't have permission to view this artwork.");
            }else{
            return Response::deny("You don't have permission to view artworks.");
            }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artwork  $artwork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Artwork $artwork)
    {
        if($user->role === "ADMIN"){
            return Response::allow();
        }else if($user->role === "ARTIST"){
            return $user->id == $artwork->artist->user_id ?
                Response::allow() :
                Response::deny("You don't have permission to view this artwork.");
        }else{
            return Response::deny("You don't have permission to view artworks.");
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artwork  $artwork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Artwork $artwork)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Artwork  $artwork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Artwork $artwork)
    {
        //
    }
}
