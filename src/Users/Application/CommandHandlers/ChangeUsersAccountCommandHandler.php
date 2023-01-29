<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\ChangeUsersAccount;
use App\Users\Domain\Models\AccountId;
use App\Users\Domain\Queries\GetAccountById;
use App\Users\Domain\Services\Repositories\UserRepository;
use Somnambulist\Components\Queries\QueryBus;

class ChangeUsersAccountCommandHandler
{
    public function __construct(private UserRepository $repository, private QueryBus $queryBus)
    {
    }

    public function __invoke(ChangeUsersAccount $command)
    {
        $this->queryBus->execute(new GetAccountById($command->accountId));

        $user = $this->repository->find($command->id);

        $user->changeAccount(new AccountId((string)$command->accountId));

        $this->repository->store($user);
    }
}
