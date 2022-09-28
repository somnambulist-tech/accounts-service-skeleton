<?php declare(strict_types=1);

namespace App\Accounts\Application\CommandHandlers;

use App\Accounts\Domain\Commands\CreateAccount;
use App\Accounts\Domain\Models\Account;
use App\Accounts\Domain\Services\Repositories\AccountRepository;

class CreateAccountCommandHandler
{
    public function __construct(private AccountRepository $accounts)
    {
    }

    public function __invoke(CreateAccount $command)
    {
        $account = Account::create(
            $command->getId(),
            $command->getName(),
        );

        $this->accounts->store($account);
    }
}
