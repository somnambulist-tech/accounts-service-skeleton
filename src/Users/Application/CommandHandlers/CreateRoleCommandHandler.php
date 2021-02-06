<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\CreateRole;
use App\Users\Domain\Models\Permission;
use App\Users\Domain\Models\PermissionName;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Services\Repositories\PermissionRepository;
use App\Users\Domain\Services\Repositories\RoleRepository;
use Somnambulist\Components\Domain\Entities\Exceptions\EntityNotFoundException;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Class CreateRoleCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\CreateRoleCommandHandler
 */
class CreateRoleCommandHandler
{

    private RoleRepository $roles;
    private PermissionRepository $permissions;

    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->roles       = $roles;
        $this->permissions = $permissions;
    }

    public function __invoke(CreateRole $command)
    {
        $role = new Role($command->getId(), $command->getName());

        foreach ($command->getRoles() as $roleId) {
            $role->roles()->grant($this->roles->find(new Uuid($roleId)));
        }
        foreach ($command->getPermissions() as $permId) {
            $role->permissions()->grant($this->getOrCreatePermission($permId));
        }

        $root = $this->roles->findByName(Role::ROLE_ROOT);
        $root->roles()->grant($role);

        $this->roles->store($role);
        $this->roles->store($root);
    }

    private function getOrCreatePermission(string $name): Permission
    {
        try {
            return $this->permissions->findByName($name);
        } catch (EntityNotFoundException $e) {
            return new Permission(new PermissionName($name));
        }
    }
}
