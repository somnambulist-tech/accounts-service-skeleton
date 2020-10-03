<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\DeactivateUser;
use App\Users\Domain\Services\Repositories\UserRepository;

/**
 * Class DeactivateUserCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\DeactivateUserCommandHandler
 */
class DeactivateUserCommandHandler
{

    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DeactivateUser $command)
    {
        $user = $this->repository->find($command->getId());
        $user->deactivate();

        $this->repository->store($user);
    }
}
