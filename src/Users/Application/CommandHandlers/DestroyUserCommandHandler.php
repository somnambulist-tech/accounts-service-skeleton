<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\DestroyUser;
use App\Users\Domain\Services\Repositories\UserRepository;

class DestroyUserCommandHandler
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(DestroyUser $command)
    {
        $user = $this->repository->find($command->getId());
        $user->destroy();

        $this->repository->destroy($user);
    }
}
