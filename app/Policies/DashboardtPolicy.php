<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardtPolicy
{
    use HandlesAuthorization;
    public function before(User $user, $ability)
    {
        if ($user->isProfesseur()){
            return true;
        }else 
            return false;
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
}
