<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\ChangeGrantableRoles;
use App\Users\Domain\Services\Repositories\RoleRepository;

class ChangeGrantableRolesCommandHandler
{
    public function __construct(private RoleRepository $roles)
    {
    }

    public function __invoke(ChangeGrantableRoles $command)
    {
        $role = $this->roles->find($command->id);
        $role->roles()->revokeAll();

        foreach ($command->roles as $roleId) {
            $role->roles()->grant($this->roles->find($roleId));
        }

        $this->roles->store($role);
    }
}
