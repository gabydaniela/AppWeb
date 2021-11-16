<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Role;
use Authorization\IdentityInterface;

/**
 * Role policy
 */
class RolePolicy
{
    /**
     * Check if $user can create Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Role $role
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Role $role)
    {
        // Only admin can create a role.
        return $user->get('role_id') === 1;
    }

    /**
     * Check if $user can update Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Role $role
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Role $role)
    {
        // Only admin can edit role.
        return $user->get('role_id') === 1;
    }

    /**
     * Check if $user can delete Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Role $role
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Role $role)
    {
        // Only admin can delete role.
        return $user->get('role_id') === 1;
    }

    /**
     * Check if $user can view Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Role $role
     * @return bool
     */
    public function canView(IdentityInterface $user, Role $role)
    {
    }
}
