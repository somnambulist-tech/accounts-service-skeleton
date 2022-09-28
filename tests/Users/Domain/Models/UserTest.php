<?php declare(strict_types=1);

namespace App\Tests\Users\Domain\Models;

use App\Tests\Support\Behaviours\UseObjectFactoryHelper;
use App\Users\Domain\Events\GrantedPermissionsToUser;
use App\Users\Domain\Events\GrantedRolesToUser;
use App\Users\Domain\Events\RevokedPermissionsFromUser;
use App\Users\Domain\Events\RevokedRolesFromUser;
use App\Users\Domain\Events\UserAccountChanged;
use App\Users\Domain\Events\UserActivated;
use App\Users\Domain\Events\UserDeactivated;
use App\Users\Domain\Events\UserDestroyed;
use App\Users\Domain\Events\UserNameChanged;
use App\Users\Domain\Models\AccountId;
use App\Users\Domain\Models\User;
use App\Users\Domain\Models\UserName;
use PHPUnit\Framework\TestCase;
use Somnambulist\Components\Domain\Utils\Tests\Assertions\AssertEntityHasPropertyWithValue;
use Somnambulist\Components\Domain\Utils\Tests\Assertions\AssertHasDomainEventOfType;

/**
 * @group users
 * @group users-domain
 * @group users-domain-models
 */
class UserTest extends TestCase
{
    use AssertHasDomainEventOfType;
    use AssertEntityHasPropertyWithValue;
    use UseObjectFactoryHelper;

    public function testMake()
    {
        $user = User::create(
            $id = $this->factory()->uuid,
            $account = new AccountId((string)$this->factory()->uuid),
            $email = $this->factory()->user->email(),
            $password = $this->factory()->user->password(),
            $name = $this->factory()->user->name(),
        );

        $this->assertEntityHasPropertyWithValue($user, 'id', $id);
        $this->assertEntityHasPropertyWithValue($user, 'account', $account);
        $this->assertEntityHasPropertyWithValue($user, 'email', $email);
        $this->assertEntityHasPropertyWithValue($user, 'password', $password);
        $this->assertEntityHasPropertyWithValue($user, 'name', $name);
    }

    public function testDestroyRaisesEvent(): void
    {
        $user = $this->factory()->user->user();
        $user->destroy();

        $this->assertHasDomainEventOfType($user, UserDestroyed::class);
    }

    public function testChangeAccount(): void
    {
        $user       = $this->factory()->user->user();
        $newAccount = $this->factory()->user->accountId();
        $user->changeAccount($newAccount);

        $this->assertEntityHasPropertyWithValue($user, 'account', $newAccount);
    }

    public function testChangeAccountRaisesEvent(): void
    {
        $user = $this->factory()->user->user();
        $user->changeAccount($this->factory()->user->accountId());

        $this->assertHasDomainEventOfType($user, UserAccountChanged::class);
    }

    public function testChangeName(): void
    {
        $user = $this->factory()->user->user();
        $user->changeName($n = new UserName('bob'));

        $this->assertEntityHasPropertyWithValue($user, 'name', $n);
    }

    public function testChangeNameRaisesEvent(): void
    {
        $user = $this->factory()->user->user();
        $user->changeName(new UserName('bob'));

        $this->assertHasDomainEventOfType($user, UserNameChanged::class);
    }

    public function testCanActivateUser(): void
    {
        $user = $this->factory()->user->user();
        $user->activate();

        $this->assertEntityHasPropertyWithValue($user, 'active', true);
    }

    public function testActivateRaisesDomainEvent(): void
    {
        $user = $this->factory()->user->user();
        $user->activate();

        $this->assertHasDomainEventOfType($user, UserActivated::class);
    }

    public function testCanDeactivateUser(): void
    {
        $user = $this->factory()->user->user();
        $user->deactivate();

        $this->assertEntityHasPropertyWithValue($user, 'active', false);
    }

    public function testDeactivateRaisesDomainEvent(): void
    {
        $user = $this->factory()->user->user();
        $user->deactivate();

        $this->assertHasDomainEventOfType($user, UserDeactivated::class);
    }

    public function testCanAddPermission()
    {
        $user = $this->factory()->user->user();
        $user->permissions()->grant($this->factory()->user->permission('perm'));

        $this->assertCount(1, $user->permissions());
    }

    public function testAddingPermissionRaisesEvent()
    {
        $user = $this->factory()->user->user();
        $user->permissions()->grant($this->factory()->user->permission('perm'));

        $this->assertHasDomainEventOfType($user, GrantedPermissionsToUser::class);
    }

    public function testCanRemovePermission()
    {
        $user = $this->factory()->user->user();
        $user->permissions()->grant($p = $this->factory()->user->permission('perm'));
        $user->permissions()->revoke($p);

        $this->assertCount(0, $user->permissions());
    }

    public function testRemovingPermissionRaisesEvent()
    {
        $user = $this->factory()->user->user();
        $user->permissions()->grant($p = $this->factory()->user->permission('perm'));
        $user->permissions()->revoke($p);

        $this->assertHasDomainEventOfType($user, RevokedPermissionsFromUser::class);
    }

    public function testCanBatchAddPermissions()
    {
        $user = $this->factory()->user->user();
        $user->permissions()->grant(...$this->factory()->user->permission('perm', 'perm', 'perm'));

        $this->assertCount(3, $user->permissions());
    }

    public function testCanAddRole()
    {
        $user = $this->factory()->user->user();
        $user->roles()->grant($this->factory()->user->role());

        $this->assertCount(1, $user->roles());
    }

    public function testAddingRoleRaisesEvent()
    {
        $user = $this->factory()->user->user();
        $user->roles()->grant($this->factory()->user->role());

        $this->assertHasDomainEventOfType($user, GrantedRolesToUser::class);
    }

    public function testCanRemoveRole()
    {
        $user = $this->factory()->user->user();
        $user->roles()->grant($r = $this->factory()->user->role());
        $user->roles()->revoke($r);

        $this->assertCount(0, $user->permissions());
    }

    public function testRemovingRoleRaisesEvent()
    {
        $user = $this->factory()->user->user();
        $user->roles()->grant($r = $this->factory()->user->role());
        $user->roles()->revoke($r);

        $this->assertHasDomainEventOfType($user, RevokedRolesFromUser::class);
    }

    public function testCanBatchAddRoles()
    {
        $user = $this->factory()->user->user();
        $user->roles()->grant($this->factory()->user->role(), $this->factory()->user->role(), $this->factory()->user->role());

        $this->assertCount(3, $user->roles());
    }
}
