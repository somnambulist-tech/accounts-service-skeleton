<?php declare(strict_types=1);

namespace App\Accounts\Application\CommandHandlers;

use App\Accounts\Domain\Commands\ChangeAccountName;
use App\Accounts\Domain\Services\Repositories\AccountRepository;

/**
 * Class ChangeAccountNameCommandHandler
 *
 * @package    App\Accounts\Application\CommandHandlers
 * @subpackage App\Accounts\Application\CommandHandlers\ChangeAccountNameCommandHandler
 */
class ChangeAccountNameCommandHandler
{
    public function __construct(private AccountRepository $repository)
    {
    }

    public function __invoke(ChangeAccountName $command)
    {
        $account = $this->repository->find($command->getId());
        $account->changeName($command->getName());

        $this->repository->store($account);
    }
}
