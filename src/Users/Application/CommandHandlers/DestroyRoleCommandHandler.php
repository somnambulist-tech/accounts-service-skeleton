<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\DestroyRole;
use App\Users\Domain\Services\Repositories\RoleRepository;
use Somnambulist\Domain\Entities\Exceptions\InvalidDomainStateException;

/**
 * Class DestroyRoleCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\DestroyRoleCommandHandler
 */
class DestroyRoleCommandHandler
{

    private RoleRepository $roles;

    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
    }

    public function __invoke(DestroyRole $command)
    {
        $role = $this->roles->find($command->getId());

        if ($role->isReserved()) {
            throw new InvalidDomainStateException(sprintf('Role "%s" is a reserved role and cannot be deleted', $command->getId()));
        }

        $this->roles->destroy($role);
    }
}
