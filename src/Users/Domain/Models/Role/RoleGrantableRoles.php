<?php declare(strict_types=1);

namespace App\Users\Domain\Models\Role;

use App\Users\Domain\Events\AllRolesHaveBeenRevokedFromRole;
use App\Users\Domain\Events\RoleHasBeenAllowedToGrantRoles;
use App\Users\Domain\Models\Role;
use Countable;
use Doctrine\Common\Collections\Collection;
use IteratorAggregate;
use Traversable;

class RoleGrantableRoles implements Countable, IteratorAggregate
{
    private Role $role;
    private Collection $roles;

    public function __construct(Role $role, Collection $roles)
    {
        $this->role  = $role;
        $this->roles = $roles;
    }

    public function count(): int
    {
        return $this->roles->count();
    }

    public function getIterator(): Traversable
    {
        return $this->roles;
    }

    public function grant(Role ...$roles): void
    {
        $granted = [];

        foreach ($roles as $role) {
            if ($this->roles->contains($role)) {
                continue;
            }

            $this->roles->add($role);
            $granted[] = $role->id();
        }

        $this->role->raise(RoleHasBeenAllowedToGrantRoles::class, [
            'roles' => $granted,
        ]);
    }

    public function revoke(Role ...$roles): void
    {
        foreach ($roles as $role) {
            $this->roles->removeElement($role);
        }

        $this->role->raise(RoleHasBeenAllowedToGrantRoles::class, [
            'roles' => array_map(fn(Role $role) => $role->id(), $roles),
        ]);
    }

    public function revokeAll(): void
    {
        $this->roles->clear();

        $this->role->raise(AllRolesHaveBeenRevokedFromRole::class);
    }
}
