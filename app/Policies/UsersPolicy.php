<?php

namespace App\Policies;

use App\Http\Requests\Request;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $currentUser,User $user)
    {
        return $currentUser->id == $user->id;
    }

    public function confirmEmail(User $currentUser, User $user)
    {
        return $currentUser->id == $user->id;
    }
}
