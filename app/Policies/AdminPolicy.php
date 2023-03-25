<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Admin $admin) {
        return $user->id === $admin->user->id;
    }
}
