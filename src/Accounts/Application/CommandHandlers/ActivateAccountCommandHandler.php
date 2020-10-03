<?php declare(strict_types=1);

namespace App\Accounts\Application\CommandHandlers;

use App\Accounts\Domain\Commands\ActivateAccount;
use App\Accounts\Domain\Services\Repositories\AccountRepository;

/**
 * Class ActivateAccountCommandHandler
 *
 * @package    App\Accounts\Application\CommandHandlers
 * @subpackage App\Accounts\Application\CommandHandlers\ActivateAccountCommandHandler
 */
class ActivateAccountCommandHandler
{

    private AccountRepository $repository;

    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ActivateAccount $command)
    {
        $account = $this->repository->find($command->getId());
        $account->activate();

        $this->repository->store($account);
    }
}
