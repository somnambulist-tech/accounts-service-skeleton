<?php declare(strict_types=1);

namespace App\Tests\Support\Factories;

use App\Accounts\Domain\Models\Account;
use Somnambulist\Components\Domain\Utils\IdentityGenerator;

class AccountFactory
{

    public function account(string $name = 'name'): Account
    {
        return Account::create(IdentityGenerator::random(), $name);
    }
}
