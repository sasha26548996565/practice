<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function admin(User $user): bool
    {
        return $user->hasRole(User::ADMIN_ROLE);
    }

    public function createUser(User $user): bool
    {
        return $user->hasPermissionTo(User::CREATE_USER_PERMISSION);
    }

    public function updateUser(User $user): bool
    {
        return $user->hasPermissionTo(User::EDIT_POST_PERMISSION);
    }
}
