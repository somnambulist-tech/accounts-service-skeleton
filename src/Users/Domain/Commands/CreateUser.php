<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use App\Users\Domain\Models\AccountId;
use Somnambulist\Components\Commands\AbstractCommand;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class CreateUser extends AbstractCommand
{
    public function __construct(
        public readonly Uuid $id,
        public readonly AccountId $account,
        public readonly string $email,
        public readonly string $password,
        public readonly string $name,
        public readonly array $roles = [],
        public readonly array $permissions = []
    ) {
    }
}
