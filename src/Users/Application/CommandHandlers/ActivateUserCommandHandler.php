<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\ActivateUser;
use App\Users\Domain\Services\Repositories\UserRepository;

class ActivateUserCommandHandler
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(ActivateUser $command)
    {
        $user = $this->repository->find($command->getId());
        $user->activate();

        $this->repository->store($user);
    }
}
