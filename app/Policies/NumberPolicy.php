<?php

namespace App\Policies;

use App\Models\Number;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NumberPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Number $number)
    {
        return $user->id === $number->board->user_id;
    }

    public function delete(User $user, Number $number)
    {
        return $user->id === $number->board->user_id;
    }
}
