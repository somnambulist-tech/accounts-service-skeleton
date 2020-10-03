<?php declare(strict_types=1);

namespace App\Tests\Support\Factories;

use App\Accounts\Domain\Models\Account;
use Somnambulist\Domain\Utils\IdentityGenerator;

/**
 * Class AccountFactory
 *
 * @package    App\Tests\Support\Factories
 * @subpackage App\Tests\Support\Factories\AccountFactory
 */
class AccountFactory
{

    public function account(string $name = 'name'): Account
    {
        return Account::create(IdentityGenerator::random(), $name);
    }
}
