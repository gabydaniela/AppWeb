<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Post;
use Authorization\IdentityInterface;

/**
 * Post policy
 */
class PostPolicy
{
    /**
     * Check if $user can create Post
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Post $post
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Post $post)
    {
        // All logged in users can create posts.
        return true;
    }

    /**
     * Check if $user can update Post
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Post $post
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Post $post)
    {
        // logged in users can edit their own post.
        return $this->isAuthor($user, $post);
    }

    /**
     * Check if $user can delete Post
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Post $post
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Post $post)
    {
        // logged in users can delete their own post.
        return $this->isAuthor($user, $post);
    }

    /**
     * Check if $user can view Post
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Post $post
     * @return bool
     */
    public function canView(IdentityInterface $user, Post $post)
    {
    }

    protected function isAuthor(IdentityInterface $user, Post $post)
    {
        return $post->author_id === $user->getIdentifier();
    }

    /*public function canIndex(IdentityInterface $user, Post $post)
    {
        // All logged in users can create posts.
        return true;
    }*/
}
