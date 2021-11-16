<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Comment;
use Authorization\IdentityInterface;

/**
 * Comment policy
 */
class CommentPolicy
{
    /**
     * Check if $user can create Comment
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Comment $comment
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Comment $comment)
    {
        // All logged in users can create comments.
        return true;
    }

    /**
     * Check if $user can update Comment
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Comment $comment
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Comment $comment)
    {
        // logged in users can edit their own comments and admin can too.
        return $user->get('role_id') === 1 || $this->isAuthor($user, $comment);
    }

    /**
     * Check if $user can delete Comment
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Comment $comment
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Comment $comment)
    {
        // logged in users can delete their own comments and admin can too
        return $user->get('role_id') === 1 || $this->isAuthor($user, $comment);
    }

    /**
     * Check if $user can view Comment
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Comment $comment
     * @return bool
     */
    public function canView(IdentityInterface $user, Comment $comment)
    {
    }

    protected function isAuthor(IdentityInterface $user, Post $post)
    {
        return $comment->email === $user->get('email');
    }
}
