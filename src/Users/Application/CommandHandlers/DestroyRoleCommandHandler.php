<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\DestroyRole;
use App\Users\Domain\Services\Repositories\RoleRepository;

class DestroyRoleCommandHandler
{
    public function __construct(private RoleRepository $roles)
    {
    }

    public function __invoke(DestroyRole $command)
    {
        $role = $this->roles->find($command->getId());
        $role->destroy();

        $this->roles->destroy($role);
    }
}
