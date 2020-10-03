<?php declare(strict_types=1);

namespace App\Users\Domain\Models\User;

use App\Users\Domain\Events\GrantedPermissionsToUser;
use App\Users\Domain\Events\RevokedPermissionsFromUser;
use App\Users\Domain\Models\Permission;
use Somnambulist\Domain\Entities\AbstractEntityCollection;
use function array_map;

/**
 * Class UserPermissions
 *
 * @package    App\Users\Domain\Models\User
 * @subpackage App\Users\Domain\Models\User\UserPermissions
 */
class UserPermissions extends AbstractEntityCollection
{

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
