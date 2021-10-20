<?php

namespace App\Policies;

use App\Models\Board;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Board  $board
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Board $board)
    {
        return $user->id === $board->user_id;
    }

    public function delete(User $user, Board $board)
    {
        return $user->id === $board->user_id;
    }
}
