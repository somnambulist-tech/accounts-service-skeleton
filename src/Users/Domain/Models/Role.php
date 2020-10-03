<?php declare(strict_types=1);

namespace App\Users\Domain\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Users\Domain\Models\Role\RoleGrantableRoles;
use App\Users\Domain\Models\Role\RolePermissions;
use Somnambulist\Domain\Entities\AggregateRoot;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Class Role
 *
 * @package    App\Users\Domain\Models
 * @subpackage App\Users\Domain\Models\Role
 */
class Role extends AggregateRoot
{

    const ROLE_ADMIN       = 'admin';
    const ROLE_ROOT        = 'root';
    const ROLE_USER        = 'user';
    const ROLE_SWITCH_USER = 'switch_user';

    private Name $name;
    private Collection $permissions;
    private Collection $roles;

    public function __construct(Uuid $id, Name $name)
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
