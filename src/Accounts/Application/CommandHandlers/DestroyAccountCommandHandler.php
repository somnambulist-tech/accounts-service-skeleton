<?php declare(strict_types=1);

namespace App\Accounts\Application\CommandHandlers;

use App\Accounts\Domain\Commands\DestroyAccount;
use App\Accounts\Domain\Queries\CountUsersOnAccount;
use App\Accounts\Domain\Services\Repositories\AccountRepository;
use Assert\Assert;
use Somnambulist\Components\Domain\Queries\QueryBus;

/**
 * Class DestroyAccountCommandHandler
 *
 * @package    App\Accounts\Application\CommandHandlers
 * @subpackage App\Accounts\Application\CommandHandlers\DestroyAccountCommandHandler
 */
class DestroyAccountCommandHandler
{

    private AccountRepository $repository;
    private QueryBus          $queryBus;

    public function __construct(AccountRepository $repository, QueryBus $queryBus)
    {
        $this->repository = $repository;
        $this->queryBus   = $queryBus;
    }

    public function __invoke(DestroyAccount $command)
    {
        $account = $this->repository->find($command->getId());
        $users   = $this->queryBus->execute(new CountUsersOnAccount($command->getId()));

        Assert::lazy()->tryAll()
            ->that($users, 'users')->eq(0, '%s Users still belong to this account.')
            ->verifyNow()
        ;

        $account->destroy();

        $this->repository->destroy($account);
    }
}
