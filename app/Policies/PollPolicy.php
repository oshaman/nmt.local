<?php

namespace Fresh\Nashemisto\Policies;

use Fresh\Nashemisto\User;
use Fresh\Nashemisto\Poll;
use Illuminate\Auth\Access\HandlesAuthorization;

class PollPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the policy.
     *
     * @param  \Fresh\Nashemisto\User $user
     * @param  \Fresh\Nashemisto\Poll $poll
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasRole('editor') || $user->hasRole('admin') ||
            $user->canDo('UPDATE_POLLS');
    }

    /**
     * Determine whether the user can create policies.
     *
     * @param  \Fresh\Nashemisto\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('editor') || $user->hasRole('admin') ||
            $user->canDo('UPDATE_POLLS');
    }

    /**
     * Determine whether the user can update the policy.
     *
     * @param  \Fresh\Nashemisto\User $user
     * @param  \Fresh\Nashemisto\Policy $poll
     * @return mixed
     */
    public function update(User $user, Poll $poll)
    {
        return $user->hasRole('editor') || $user->hasRole('admin') ||
            ($user->canDo('UPDATE_POLLS') && ($user->id == $poll->user_id));
    }

    /**
     * Determine whether the user can delete the policy.
     *
     * @param  \Fresh\Nashemisto\User $user
     * @param  \Fresh\Nashemisto\Policy $poll
     * @return mixed
     */
    public function delete(User $user, Poll $poll)
    {
        return $user->hasRole('editor') || $user->hasRole('admin');
    }
}
