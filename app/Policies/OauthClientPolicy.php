<?php

namespace App\Policies;

use App\Itsjeffro\OauthClient;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OauthClientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the client.
     *
     * @param  \App\User  $user
     * @param  \App\OauthClient  $client
     * @return mixed
     */
    public function view(User $user, OauthClient $client)
    {
        if ($user->id === $client->user_id) {
            return true;
        }

        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the client.
     *
     * @param  \App\User  $user
     * @param  \App\OauthClient  $client
     * @return mixed
     */
    public function update(User $user, OauthClient $client)
    {
        if ($user->id === $client->user_id) {
            return true;
        }

        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the client.
     *
     * @param  \App\User  $user
     * @param  \App\OauthClient  $client
     * @return mixed
     */
    public function delete(User $user, OauthClient $client)
    {
        if ($user->id === $client->user_id) {
            return true;
        }

        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the client.
     *
     * @param  \App\User  $user
     * @param  \App\OauthClient  $client
     * @return mixed
     */
    public function restore(User $user, OauthClient $client)
    {
        if ($user->id === $client->user_id) {
            return true;
        }

        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the client.
     *
     * @param  \App\User  $user
     * @param  \App\OauthClient  $client
     * @return mixed
     */
    public function forceDelete(User $user, OauthClient $client)
    {
        if ($user->id === $client->user_id) {
            return true;
        }

        return $user->hasRole('admin');
    }
}
