<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\CreateUser;
use App\Users\Domain\Models\Name;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\User;
use App\Users\Domain\Queries\FindAccountById;
use App\Users\Domain\Services\Repositories\PermissionRepository;
use App\Users\Domain\Services\Repositories\RoleRepository;
use App\Users\Domain\Services\Repositories\UserRepository;
use Somnambulist\Domain\Entities\Types\Auth\Password;
use Somnambulist\Domain\Entities\Types\Identity\EmailAddress;
use Somnambulist\Domain\Queries\QueryBus;

/**
 * Class CreateUserCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\CreateUserCommandHandler
 */
class CreateUserCommandHandler
{

    private UserRepository $users;
    private RoleRepository $roles;
    private PermissionRepository $permissions;
    private QueryBus $queryBus;

    public function __construct(UserRepository $users, RoleRepository $roles, PermissionRepository $permissions, QueryBus $queryBus)
    {
        $this->users       = $users;
        $this->roles       = $roles;
        $this->permissions = $permissions;
        $this->queryBus    = $queryBus;
    }

    public function __invoke(CreateUser $command)
    {
        $this->queryBus->execute(new FindAccountById($command->getAccount()->toUuid()));

        $user = User::create(
            $command->getId(),
            $command->getAccount(),
            new EmailAddress($command->getEmail()),
            new Password($command->getPassword()),
            new Name($command->getName())
        );

        $user->roles()->grant($this->roles->findByName(Role::ROLE_USER));

        foreach ($command->getRoles() as $role) {
            $user->roles()->grant($this->roles->findByName($role));
        }
        foreach ($command->getPermissions() as $perm) {
            $user->permissions()->grant($this->permissions->findByName($perm));
        }

        $this->users->store($user);
    }
}
