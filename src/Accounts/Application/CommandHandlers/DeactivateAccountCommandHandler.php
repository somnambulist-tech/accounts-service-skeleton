<?php declare(strict_types=1);

namespace App\Accounts\Application\CommandHandlers;

use App\Accounts\Domain\Commands\DeactivateAccount;
use App\Accounts\Domain\Services\Repositories\AccountRepository;

class DeactivateAccountCommandHandler
{
    public function __construct(private AccountRepository $repository)
    {
    }

    public function __invoke(DeactivateAccount $command)
    {
        $account = $this->repository->find($command->getId());
        $account->deactivate();

        $this->repository->store($account);
    }
}
