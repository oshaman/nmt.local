<?php

namespace Fresh\Nashemisto\Policies;

use Fresh\Nashemisto\User;
use Fresh\Nashemisto\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the video.
     *
     * @param  \Fresh\Nashemisto\User $user
     * @param  \Fresh\Nashemisto\Video $video
     * @return mixed
     */
    public function view(User $user, Video $video)
    {
        return $user->hasRole('video_editor') || $user->hasRole('admin') ||
            $user->canDo('UPDATE_VIDEO');
    }

    /**
     * Determine whether the user can create videos.
     *
     * @param  \Fresh\Nashemisto\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('video_editor') || $user->hasRole('admin') ||
            $user->canDo('UPDATE_VIDEO');
    }

    /**
     * Determine whether the user can update the video.
     *
     * @param  \Fresh\Nashemisto\User $user
     * @param  \Fresh\Nashemisto\Video $video
     * @return mixed
     */
    public function update(User $user, Video $video)
    {
        return $user->hasRole('video_editor') || $user->hasRole('admin') ||
            ($user->canDo('UPDATE_VIDEO') && ($user->id == $video->user_id));
    }

    /**
     * Determine whether the user can delete the video.
     *
     * @param  \Fresh\Nashemisto\User $user
     * @param  \Fresh\Nashemisto\Video $video
     * @return mixed
     */
    public function delete(User $user, Video $video)
    {
        return $user->hasRole('video_editor') || $user->hasRole('admin');
    }
}
