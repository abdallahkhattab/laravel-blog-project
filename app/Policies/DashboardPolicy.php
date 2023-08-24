<?php

namespace App\Policies;

use App\Models\User;

class DashboardPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function access(User $user){
        return $user->type ==='admin';
    }
}
