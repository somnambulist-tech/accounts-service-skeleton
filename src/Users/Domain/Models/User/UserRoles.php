<?php declare(strict_types=1);

namespace App\Users\Domain\Models\User;

use App\Users\Domain\Events\GrantedRolesToUser;
use App\Users\Domain\Events\RevokedRolesFromUser;
use App\Users\Domain\Models\Role;
use Somnambulist\Domain\Entities\AbstractEntityCollection;
use function array_map;

/**
 * Class UserRoles
 *
 * @package    App\Users\Domain\Models\User
 * @subpackage App\Users\Domain\Models\User\UserRoles
 */
class UserRoles extends AbstractEntityCollection
{

    public function grant(Role ...$roles): void
    {
        $granted = [];

        foreach ($roles as $role) {
            if ($this->entities->contains($role)) {
                continue;
            }

            $this->entities->add($role);

            $granted[] = (string)$role->id();
        }

        $this->root->raise(GrantedRolesToUser::class, [
            'id'    => (string)$this->root->id(),
            'roles' => $granted,
        ]);
    }

    public function revoke(Role ...$roles): void
    {
        foreach ($roles as $role) {
            $this->entities->removeElement($role);
        }

        $this->root->raise(RevokedRolesFromUser::class, [
            'id'    => (string)$this->root->id(),
            'roles' => array_map(fn(Role $role) => (string)$role->id(), $roles),
        ]);
    }
}
