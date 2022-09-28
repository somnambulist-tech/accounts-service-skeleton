<?php declare(strict_types=1);

namespace App\Users\Domain\Models;

use App\Users\Domain\Models\Role\RoleGrantableRoles;
use App\Users\Domain\Models\Role\RolePermissions;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Somnambulist\Components\Models\AggregateRoot;
use Somnambulist\Components\Models\Exceptions\InvalidDomainStateException;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use function sprintf;

class Role extends AggregateRoot
{
    const ROLE_ADMIN       = 'admin';
    const ROLE_ROOT        = 'root';
    const ROLE_USER        = 'user';
    const ROLE_SWITCH_USER = 'allowed_to_switch';

    private RoleName   $name;
    private Collection $permissions;
    private Collection $roles;

    public function __construct(Uuid $id, RoleName $name)
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->roles       = new ArrayCollection();
        $this->permissions = new ArrayCollection();

        $this->initializeTimestamps();
    }

    /**
     * @internal
     */
    public function updateTimestamps(): void
    {
        $this->changeLastUpdatedToNow();
    }

    public function destroy(): void
    {
        if ($this->isReserved()) {
            throw new InvalidDomainStateException(sprintf('Role "%s" is a reserved role and cannot be deleted', $this->id()));
        }
    }

    public function isReserved(): bool
    {
        return in_array((string)$this->name, [self::ROLE_USER, self::ROLE_ROOT, self::ROLE_SWITCH_USER]);
    }

    public function permissions(): RolePermissions
    {
        return new RolePermissions($this, $this->permissions);
    }

    public function roles(): RoleGrantableRoles
    {
        return new RoleGrantableRoles($this, $this->roles);
    }
}
