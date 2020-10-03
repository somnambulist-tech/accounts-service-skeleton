<?php declare(strict_types=1);

namespace App\Accounts\Application\CommandHandlers;

use App\Accounts\Domain\Commands\DeactivateAccount;
use App\Accounts\Domain\Services\Repositories\AccountRepository;

/**
 * Class DeactivateAccountCommandHandler
 *
 * @package    App\Accounts\Application\CommandHandlers
 * @subpackage App\Accounts\Application\CommandHandlers\DeactivateAccountCommandHandler
 */
class DeactivateAccountCommandHandler
{

    private AccountRepository $repository;

    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(DeactivateAccount $command)
    {
        $account = $this->repository->find($command->getId());
        $account->deactivate();

        $this->repository->store($account);
    }
}
