<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\ChangeRolePermissions;
use App\Users\Domain\Models\Name;
use App\Users\Domain\Models\Permission;
use App\Users\Domain\Services\Repositories\PermissionRepository;
use App\Users\Domain\Services\Repositories\RoleRepository;
use Somnambulist\Domain\Entities\Exceptions\EntityNotFoundException;

/**
 * Class ChangeRolePermissionsCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\ChangeRolePermissionsCommandHandler
 */
class ChangeRolePermissionsCommandHandler
{

    private RoleRepository $roles;
    private PermissionRepository $permissions;

    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->roles       = $roles;
        $this->permissions = $permissions;
    }

    public function __invoke(ChangeRolePermissions $command)
    {
        $role = $this->roles->find($command->getId());
        $role->permissions()->revokeAll();

        foreach ($command->getPermissions() as $permId) {
            $role->permissions()->grant($this->getOrCreatePermission($permId));
        }

        $this->roles->store($role);
    }

    private function getOrCreatePermission(string $name): Permission
    {
        try {
            return $this->permissions->findByName($name);
        } catch (EntityNotFoundException $e) {
            return new Permission(new Name($name));
        }
    }
}
