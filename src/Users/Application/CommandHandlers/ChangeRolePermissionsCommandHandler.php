<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\ChangeRolePermissions;
use App\Users\Domain\Models\Permission;
use App\Users\Domain\Models\PermissionName;
use App\Users\Domain\Services\Repositories\PermissionRepository;
use App\Users\Domain\Services\Repositories\RoleRepository;
use Somnambulist\Components\Models\Exceptions\EntityNotFoundException;

class ChangeRolePermissionsCommandHandler
{
    public function __construct(private RoleRepository $roles, private PermissionRepository $permissions)
    {
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
        } catch (EntityNotFoundException) {
            return new Permission(new PermissionName($name));
        }
    }
}
