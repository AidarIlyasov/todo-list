<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Board;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any boards.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the board.
     *
     * @param  User $user
     * @param  Board $board
     * @return mixed
     */
    public function view()
    {

//        dump($user->id);
//        dd($board->id);
//        return $user->id ===
        return true;
    }

    /**
     * Determine whether the user can create boards.
     *
     * @param  User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the board.
     *
     * @param  User $user
     * @param  Board $board
     * @return bool
     */
    public function update(User $user, Board $board)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the board.
     *
     * @param  User $user
     * @param  Board $board
     * @return mixed
     */
    public function delete(User $user, Board $board)
    {
        //
    }

    /**
     * Determine whether the user can restore the board.
     *
     * @param  User $user
     * @param  Board $board
     * @return mixed
     */
    public function restore(User $user, Board $board)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the board.
     *
     * @param  User $user
     * @param  Board $board
     * @return mixed
     */
    public function forceDelete(User $user, Board $board)
    {
        //
    }
}
