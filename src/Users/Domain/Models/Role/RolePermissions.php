<?php declare(strict_types=1);

namespace App\Users\Domain\Models\Role;

use App\Users\Domain\Models\Permission;
use App\Users\Domain\Models\Role;
use Countable;
use Doctrine\Common\Collections\Collection;
use IteratorAggregate;
use Traversable;

class RolePermissions implements Countable, IteratorAggregate
{
    private Role $role;
    private Collection $permissions;

    public function __construct(Role $role, Collection $permissions)
    {
        $this->role        = $role;
        $this->permissions = $permissions;
    }

    public function count(): int
    {
        return $this->permissions->count();
    }

    public function getIterator(): Traversable
    {
        return $this->permissions;
    }

    public function grant(Permission ...$permissions): void
    {
        foreach ($permissions as $permission) {
            if ($this->permissions->contains($permission)) {
                continue;
            }

            $this->permissions->add($permission);
        }

        $this->role->updateTimestamps();
    }

    public function revoke(Permission ...$permissions): void
    {
        foreach ($permissions as $permission) {
            $this->permissions->removeElement($permission);
        }

        $this->role->updateTimestamps();
    }

    public function revokeAll(): void
    {
        $this->permissions->clear();

        $this->role->updateTimestamps();
    }
}
