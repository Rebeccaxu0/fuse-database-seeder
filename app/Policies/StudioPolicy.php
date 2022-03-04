<?php

namespace App\Policies;

use App\Models\Studio;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StudioPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
      if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Studio $studio)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Studio $studio)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Studio $studio)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Studio $studio)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Studio $studio)
    {
        //
    }

    /**
     * Determine whether the user can switch to a given model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function switch(User $user, Studio $studio)
    {
      return $user->deFactoStudios()->contains($studio);
    }

    /**
     * Determine whether the user can export Studio activity.
     *
     * @param \App\Models\User  $user
     * @param \App\Models\Studio $studio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function exportActivity(User $user, Studio $studio)
    {
        return ($user->isFacilitator() || $user->isSuperFacilitator())
               && $user->deFactoStudios()->contains($studio)
          ? Response::allow()
          : Response::deny(__('You are either not a facilitator or a member of this studio.'));
    }
}
