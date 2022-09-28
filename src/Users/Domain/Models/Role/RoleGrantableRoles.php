<?php declare(strict_types=1);

namespace App\Users\Domain\Models\Role;

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
        foreach ($roles as $role) {
            if ($this->roles->contains($role)) {
                continue;
            }

            $this->roles->add($role);
        }

        $this->role->updateTimestamps();
    }

    public function revoke(Role ...$roles): void
    {
        foreach ($roles as $role) {
            $this->roles->removeElement($role);
        }

        $this->role->updateTimestamps();
    }

    public function revokeAll(): void
    {
        $this->roles->clear();

        $this->role->updateTimestamps();
    }
}
