<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\CreateUser;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\User;
use App\Users\Domain\Models\UserName;
use App\Users\Domain\Queries\GetAccountById;
use App\Users\Domain\Services\Repositories\PermissionRepository;
use App\Users\Domain\Services\Repositories\RoleRepository;
use App\Users\Domain\Services\Repositories\UserRepository;
use Somnambulist\Components\Models\Types\Auth\Password;
use Somnambulist\Components\Models\Types\Identity\EmailAddress;
use Somnambulist\Components\Queries\QueryBus;

class CreateUserCommandHandler
{
    public function __construct(
        private UserRepository $users,
        private RoleRepository $roles,
        private PermissionRepository $permissions,
        private QueryBus $queryBus
    ) {
    }

    public function __invoke(CreateUser $command)
    {
        $this->queryBus->execute(new GetAccountById($command->getAccount()->toUuid()));

        $user = User::create(
            $command->getId(),
            $command->getAccount(),
            new EmailAddress($command->getEmail()),
            new Password($command->getPassword()),
            new UserName($command->getName())
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
