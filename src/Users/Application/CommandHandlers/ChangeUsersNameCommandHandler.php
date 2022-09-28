<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\ChangeUsersName;
use App\Users\Domain\Models\UserName;
use App\Users\Domain\Services\Repositories\UserRepository;

class ChangeUsersNameCommandHandler
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(ChangeUsersName $command)
    {
        $user = $this->repository->find($command->getId());
        $user->changeName(new UserName($command->getName()));

        $this->repository->store($user);
    }
}
