<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\DestroyUser;
use App\Users\Domain\Services\Repositories\UserRepository;

/**
 * Class DestroyUserCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\DestroyUserCommandHandler
 */
class DestroyUserCommandHandler
{

    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DestroyUser $command)
    {
        $user = $this->repository->find($command->getId());
        $user->destroy();

        $this->repository->destroy($user);
    }
}
