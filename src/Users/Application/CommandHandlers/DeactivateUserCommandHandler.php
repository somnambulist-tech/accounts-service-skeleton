<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\DeactivateUser;
use App\Users\Domain\Services\Repositories\UserRepository;

class DeactivateUserCommandHandler
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(DeactivateUser $command)
    {
        $user = $this->repository->find($command->getId());
        $user->deactivate();

        $this->repository->store($user);
    }
}
