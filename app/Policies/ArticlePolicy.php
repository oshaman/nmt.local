<?php

namespace Fresh\Nashemisto\Policies;

use Fresh\Nashemisto\User;
use Fresh\Nashemisto\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the article.
     *
     * @param  \Fresh\Nashemisto\User $user
     * @param  \Fresh\Nashemisto\Article $article
     * @return mixed
     */
    public function view(User $user, Article $article)
    {
        //
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  \Fresh\Nashemisto\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('editor') || $user->hasRole('admin') ||
            $user->canDo('UPDATE_ARTICLES');
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  \Fresh\Nashemisto\User $user
     * @param  \Fresh\Nashemisto\Article $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        return $user->hasRole('editor') || $user->hasRole('admin') ||
            ($user->canDo('UPDATE_ARTICLES') && ($user->id == $article->user_id));
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \Fresh\Nashemisto\User $user
     * @param  \Fresh\Nashemisto\Article $article
     * @return mixed
     */
    public function delete(User $user, Article $article)
    {
        return $user->hasRole('editor') || $user->hasRole('admin') ||
            ($user->canDo('UPDATE_ARTICLES') && ($user->id == $article->user_id));
    }
}
