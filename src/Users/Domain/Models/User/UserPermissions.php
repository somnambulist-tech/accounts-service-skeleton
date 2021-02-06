<?php declare(strict_types=1);

namespace App\Users\Domain\Models\User;

use App\Users\Domain\Events\GrantedPermissionsToUser;
use App\Users\Domain\Events\RevokedPermissionsFromUser;
use App\Users\Domain\Models\Permission;
use App\Users\Domain\Models\User;
use Countable;
use Doctrine\Common\Collections\Collection;
use IteratorAggregate;
use function array_map;

/**
 * Class UserPermissions
 *
 * @package    App\Users\Domain\Models\User
 * @subpackage App\Users\Domain\Models\User\UserPermissions
 */
class UserPermissions implements Countable, IteratorAggregate
{

    private User       $root;
    private Collection $entities;

    public function __construct(User $user, Collection $permissions)
    {
        $this->root     = $user;
        $this->entities = $permissions;
    }

    public function getIterator()
    {
        return $this->entities;
    }

    public function count()
    {
        return $this->entities->count();
    }

    public function grant(Permission ...$permissions): void
    {
        $granted = [];

        foreach ($permissions as $permission) {
            if ($this->entities->contains($permission)) {
                continue;
            }

            $this->entities->add($permission);

            $granted[] = $permission->name();
        }

        $this->root->raise(GrantedPermissionsToUser::class, [
            'id'          => (string)$this->root->id(),
            'permissions' => $granted,
        ]);
    }

    public function revoke(Permission ...$permissions): void
    {
        foreach ($permissions as $permission) {
            $this->entities->removeElement($permission);
        }

        $this->root->raise(RevokedPermissionsFromUser::class, [
            'id'          => (string)$this->root->id(),
            'permissions' => array_map(fn(Permission $permission) => $permission->name(), $permissions),
        ]);
    }
}
