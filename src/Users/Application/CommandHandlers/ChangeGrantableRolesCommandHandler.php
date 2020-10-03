<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\ChangeGrantableRoles;
use App\Users\Domain\Services\Repositories\RoleRepository;

/**
 * Class ChangeGrantableRolesCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\ChangeGrantableRolesCommandHandler
 */
class ChangeGrantableRolesCommandHandler
{

    private RoleRepository $roles;

    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
    }

    public function __invoke(ChangeGrantableRoles $command)
    {
        $role = $this->roles->find($command->getId());
        $role->roles()->revokeAll();

        foreach ($command->getRoles() as $roleId) {
            $role->roles()->grant($this->roles->find($roleId));
        }

        $this->roles->store($role);
    }
}
