<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\CreatePermission;
use App\Users\Domain\Models\Permission;
use App\Users\Domain\Services\Repositories\PermissionRepository;

/**
 * Class CreatePermissionCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\CreatePermissionCommandHandler
 */
class CreatePermissionCommandHandler
{

    private PermissionRepository $permissions;

    public function __construct(PermissionRepository $permissions)
    {
        $this->permissions = $permissions;
    }

    public function __invoke(CreatePermission $command)
    {
        $this->permissions->store(new Permission($command->getName()));
    }
}
