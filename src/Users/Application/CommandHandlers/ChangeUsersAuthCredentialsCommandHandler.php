<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use Assert\InvalidArgumentException;
use App\Users\Domain\Commands\ChangeUsersAuthCredentials;
use App\Users\Domain\Queries\FindUsers;
use App\Users\Domain\Services\Repositories\UserRepository;
use Pagerfanta\Pagerfanta;
use Somnambulist\Domain\Entities\Types\Auth\Password;
use Somnambulist\Domain\Entities\Types\Identity\EmailAddress;
use Somnambulist\Domain\Queries\QueryBus;
use function sprintf;

/**
 * Class ChangeUsersAuthCredentialsCommandHandler
 *
 * @package    App\Users\Application\CommandHandlers
 * @subpackage App\Users\Application\CommandHandlers\ChangeUsersAuthCredentialsCommandHandler
 */
class ChangeUsersAuthCredentialsCommandHandler
{

    private UserRepository $users;
    private QueryBus $queryBus;

    public function __construct(UserRepository $repository, QueryBus $queryBus)
    {
        $this->users    = $repository;
        $this->queryBus = $queryBus;
    }

    public function __invoke(ChangeUsersAuthCredentials $command)
    {
        $user = $this->users->find($command->getId());

        /** @var Pagerfanta $results */
        $results = $this->queryBus->execute(new FindUsers(['email' => $command->getEmail()], [], 1, 1));
        $test    = $results->getCurrentPageResults()[0] ?? null;

        if (!is_null($test) && !$user->id()->equals($test->id)) {
            $message = sprintf('Cannot change email as a User with email "%s" already exists', $command->getEmail());

            throw new InvalidArgumentException($message, 400, 'email', $command->getEmail());
        }

        $user->changeAuthCredentials(new EmailAddress($command->getEmail()), new Password($command->getPassword()));

        $this->users->store($user);
    }
}
