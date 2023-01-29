<?php declare(strict_types=1);

namespace App\Accounts\Application\CommandHandlers;

use App\Accounts\Domain\Commands\ChangeAccountName;
use App\Accounts\Domain\Services\Repositories\AccountRepository;

class ChangeAccountNameCommandHandler
{
    public function __construct(private AccountRepository $repository)
    {
    }

    public function __invoke(ChangeAccountName $command)
    {
        $account = $this->repository->find($command->id);
        $account->changeName($command->name);

        $this->repository->store($account);
    }
}
