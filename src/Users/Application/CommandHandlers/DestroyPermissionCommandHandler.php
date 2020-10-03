<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\DestroyPermission;
use App\Users\Infrastructure\Persistence\Repositories\PermissionRepository;

/**
 * Class DestroyPermissionCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\DestroyPermissionCommandHandler
 */
class DestroyPermissionCommandHandler
{

    private PermissionRepository $permissions;

    public function __construct(PermissionRepository $permissions)
    {
        $this->permissions = $permissions;
    }

    public function __invoke(DestroyPermission $command)
    {
        $perm = $this->permissions->findByName($command->getName());

        $this->permissions->destroy($perm);
    }
}
