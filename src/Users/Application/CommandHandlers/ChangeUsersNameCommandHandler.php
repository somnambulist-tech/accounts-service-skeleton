<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\ChangeUsersName;
use App\Users\Domain\Models\Name;
use App\Users\Domain\Services\Repositories\UserRepository;

/**
 * Class ChangeUsersNameCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\ChangeUsersNameCommandHandler
 */
class ChangeUsersNameCommandHandler
{

    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ChangeUsersName $command)
    {
        $user = $this->repository->find($command->getId());
        $user->changeName(new Name($command->getName()));

        $this->repository->store($user);
    }
}
