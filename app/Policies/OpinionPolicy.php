<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Opinion;
use App\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class OpinionPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user,Student $student, Opinion $opinion)
    {
        if ($user->isAdmin()){
            return true;
        }elseif ($user->isParent()){
                return $user->id === $student->users_id & $student->id === $opinion->student_id;
            }else 
            return false;
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
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Opinion $opinion)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Opinion $opinion)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Opinion $opinion)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Opinion  $opinion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Opinion $opinion)
    {
        //
    }
}
