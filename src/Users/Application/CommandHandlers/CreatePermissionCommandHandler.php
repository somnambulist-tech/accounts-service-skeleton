<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\CreatePermission;
use App\Users\Domain\Models\Permission;
use App\Users\Domain\Services\Repositories\PermissionRepository;

class CreatePermissionCommandHandler
{
    public function __construct(private PermissionRepository $permissions)
    {
    }

    public function __invoke(CreatePermission $command)
    {
        $this->permissions->store(new Permission($command->getName()));
    }
}
