<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\ChangeUsersAccount;
use App\Users\Domain\Models\AccountId;
use App\Users\Domain\Queries\FindAccountById;
use App\Users\Domain\Services\Repositories\UserRepository;
use Somnambulist\Domain\Queries\QueryBus;

/**
 * Class ChangeUsersAccountCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\ChangeUsersAccountCommandHandler
 */
class ChangeUsersAccountCommandHandler
{

    protected UserRepository $repository;
    protected QueryBus $queryBus;

    public function __construct(UserRepository $repository, QueryBus $queryBus)
    {
        $this->repository = $repository;
        $this->queryBus   = $queryBus;
    }

    public function __invoke(ChangeUsersAccount $command)
    {
        $this->queryBus->execute(new FindAccountById($command->getAccountId()));

        $user = $this->repository->find($command->getId());

        $user->changeAccount(new AccountId((string)$command->getAccountId()));

        $this->repository->store($user);
    }
}
