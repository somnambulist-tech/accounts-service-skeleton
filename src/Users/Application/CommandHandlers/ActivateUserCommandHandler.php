<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\ActivateUser;
use App\Users\Domain\Services\Repositories\UserRepository;

/**
 * Class ActivateUserCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\ActivateUserCommandHandler
 */
class ActivateUserCommandHandler
{

    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ActivateUser $command)
    {
        $user = $this->repository->find($command->getId());
        $user->activate();

        $this->repository->store($user);
    }
}
