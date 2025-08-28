<?php

namespace App\Policies;

use App\Models\ProgrammeUser;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProgrammeUsersPolicy
{
    use HandlesAuthorization;
    public function before(User $user, $ability)
    {
        if ($user->isAdmin()){
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProgrammeUser  $programmeUsers
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ProgrammeUser $programme_users)
    {
        return true;
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
     * @param  \App\Models\ProgrammeUser  $programmeUsers
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProgrammeUser $programme_users)
    {
       //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProgrammeUsers  $programmeUsers
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProgrammeUser $programmeUsers)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProgrammeUsers  $programmeUsers
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ProgrammeUser $programmeUsers)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProgrammeUser  $programmeUsers
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ProgrammeUser $programmeUsers)
    {
        //
    }
}
