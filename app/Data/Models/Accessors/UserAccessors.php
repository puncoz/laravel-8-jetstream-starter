<?php

namespace App\Data\Models\Accessors;

use App\Constants\AuthRolesPermissions;
use App\Data\Models\Entities\Role;

/**
 * Trait UserAccessors
 * @package App\Data\Models\Accessors
 */
trait UserAccessors
{
    /**
     * @return string
     */
    public function getDisplayNameAttribute(): string
    {
        if ( $this->name ) {
            return $this->name;
        }

        return $this->email;
    }

    /**
     * @return Role|null
     */
    public function getPrimaryRoleAttribute(): ?Role
    {
        if ( $this->roles->isEmpty() ) {
            return null;
        }

        return $this->roles->first();
    }

    /**
     * @return bool
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->hasRole(AuthRolesPermissions::ROLE_ADMIN);
    }
}
