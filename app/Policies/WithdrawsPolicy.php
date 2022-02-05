<?php

namespace App\Policies;

use App\User;
use App\UserWithdraw;
use Illuminate\Auth\Access\HandlesAuthorization;

class WithdrawsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any user withdraws.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        
    }

    /**
     * Determine whether the user can view the user withdraw.
     *
     * @param  \App\User  $user
     * @param  \App\UserWithdraw  $userWithdraw
     * @return mixed
     */
    public function view(User $user, UserWithdraw $userWithdraw)
    {
        //
        return true; //$user->id === $userWithdraw->user_id;
        
    }

    /**
     * Determine whether the user can create user withdraws.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user withdraw.
     *
     * @param  \App\User  $user
     * @param  \App\UserWithdraw  $userWithdraw
     * @return mixed
     */
    public function update(User $user, UserWithdraw $userWithdraw)
    {
        //
    }

    /**
     * Determine whether the user can delete the user withdraw.
     *
     * @param  \App\User  $user
     * @param  \App\UserWithdraw  $userWithdraw
     * @return mixed
     */
    public function delete(User $user, UserWithdraw $userWithdraw)
    {
        //
    }

    /**
     * Determine whether the user can restore the user withdraw.
     *
     * @param  \App\User  $user
     * @param  \App\UserWithdraw  $userWithdraw
     * @return mixed
     */
    public function restore(User $user, UserWithdraw $userWithdraw)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user withdraw.
     *
     * @param  \App\User  $user
     * @param  \App\UserWithdraw  $userWithdraw
     * @return mixed
     */
    public function forceDelete(User $user, UserWithdraw $userWithdraw)
    {
        //
    }
}
