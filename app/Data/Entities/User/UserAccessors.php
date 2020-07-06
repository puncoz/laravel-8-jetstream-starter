<?php

namespace App\Data\Entities\User;

/**
 * Trait UserAccessors
 * @package App\Data\Entities\User
 */
trait UserAccessors
{
    /**
     * @return string
     */
    public function getDisplayNameAttribute(): string
    {
        /** @var User $this */
        if ( $this->full_name ) {
            return trim(collect($this->full_name)->implode(' '));
        }

        if ( $this->username ) {
            return $this->username;
        }

        return $this->email;
    }

    /**
     * @return string
     */
    public function getInitialsAttribute(): string
    {
        $exploded = explode(' ', $this->display_name);
        if ( count($exploded) === 1 ) {
            return strtoupper($exploded[0][0]);
        }

        return strtoupper($exploded[0][0].end($exploded)[0]);
    }

    /**
     * @return Role
     */
    public function getPrimaryRoleAttribute(): ?Role
    {
        /** @var User $this */
        $roles = $this->roles;

        if ( $roles->isEmpty() ) {
            return null;
        }

        return $roles->first();
    }
}
