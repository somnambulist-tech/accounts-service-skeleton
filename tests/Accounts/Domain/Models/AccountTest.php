<?php declare(strict_types=1);

namespace App\Tests\Accounts\Domain\Models;

use App\Accounts\Domain\Events\AccountCreated;
use App\Accounts\Domain\Events\AccountDestroyed;
use App\Accounts\Domain\Events\AccountNameUpdated;
use App\Accounts\Domain\Models\Account;
use App\Tests\Support\Behaviours\UseObjectFactoryHelper;
use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;
use Somnambulist\Components\Domain\Utils\IdentityGenerator;
use Somnambulist\Components\Domain\Utils\Tests\Assertions\AssertEntityHasPropertyWithValue;
use Somnambulist\Components\Domain\Utils\Tests\Assertions\AssertHasDomainEventOfType;

/**
 * @group accounts
 * @group accounts-domain
 * @group accounts-domain-models
 */
class AccountTest extends TestCase
{
    use AssertHasDomainEventOfType;
    use AssertEntityHasPropertyWithValue;
    use UseObjectFactoryHelper;

    public function testCreating(): void
    {
        $account = Account::create(
            $id = IdentityGenerator::random(),
            $name = 'name'
        );

        $this->assertEntityHasPropertyWithValue($account, 'id', $id);
        $this->assertEntityHasPropertyWithValue($account, 'name', $name);
    }

    public function testCreatingRaisesEvent(): void
    {
        $account = $this->factory()->account->account();

        $this->assertHasDomainEventOfType($account, AccountCreated::class);
    }

    public function testCreateThrowsAssertionErrorWithEmptyName(): void
    {
        $this->expectException(AssertionFailedException::class);

        $this->factory()->account->account('');
    }

    public function testChangeName(): void
    {
        $account = $this->factory()->account->account();
        $account->changeName('Updated');

        $this->assertEntityHasPropertyWithValue($account, 'name', 'Updated');
    }

    public function testChangeNameThrowsAssertionErrorWithEmptyName(): void
    {
        $this->expectException(AssertionFailedException::class);

        $account = $this->factory()->account->account();
        $account->changeName('');
    }

    public function testUpdateNameRaisesEvent(): void
    {
        $account = $this->factory()->account->account();
        $account->changeName('Updated');

        $this->assertHasDomainEventOfType($account, AccountNameUpdated::class);
    }

    public function testDestroyRaisesEvent(): void
    {
        $account = $this->factory()->account->account();
        $account->destroy();

        $this->assertHasDomainEventOfType($account, AccountDestroyed::class);
    }
}
