<?php declare(strict_types=1);

namespace App\Users\Application\CommandHandlers;

use App\Users\Domain\Commands\ChangeUsersAuthCredentials;
use App\Users\Domain\Queries\DoesUserExistWithEmail;
use App\Users\Domain\Services\Repositories\UserRepository;
use Assert\InvalidArgumentException;
use Somnambulist\Components\Models\Types\Auth\Password;
use Somnambulist\Components\Models\Types\Identity\EmailAddress;
use Somnambulist\Components\Queries\QueryBus;

use function sprintf;

class ChangeUsersAuthCredentialsCommandHandler
{
    public function __construct(private UserRepository $users, private QueryBus $queryBus)
    {
    }

    public function __invoke(ChangeUsersAuthCredentials $command)
    {
        $user = $this->users->find($command->id);

        if ($this->queryBus->execute(new DoesUserExistWithEmail($command->email, $command->id))) {
            $message = sprintf('Cannot change email as a User with email "%s" already exists', $command->email);

            throw new InvalidArgumentException($message, 422, 'email', $command->email);
        }

        $user->changeAuthCredentials(new EmailAddress($command->email), new Password($command->password));

        $this->users->store($user);
    }
}
