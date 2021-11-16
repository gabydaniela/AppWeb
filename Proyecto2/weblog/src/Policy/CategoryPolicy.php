<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Category;
use Authorization\IdentityInterface;

/**
 * Category policy
 */
class CategoryPolicy
{
    /**
     * Check if $user can create Category
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Category $category
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Category $category)
    {
         // Only admin can create category.
         return $user->get('role_id') === 1;
    }

    /**
     * Check if $user can update Category
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Category $category
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Category $category)
    {
        // Only admin can edit category.
        return $user->get('role_id') === 1;
    }

    /**
     * Check if $user can delete Category
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Category $category
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Category $category)
    {
        // Only admin can delete category.
        return $user->get('role_id') === 1;
    }

    /**
     * Check if $user can view Category
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Category $category
     * @return bool
     */
    public function canView(IdentityInterface $user, Category $category)
    {
    }
}
