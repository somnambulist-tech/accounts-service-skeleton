<?php declare(strict_types=1);

namespace App\Tests\Users\Domain\Models;

use App\Tests\Support\Behaviours\UseObjectFactoryHelper;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\RoleName;
use PHPUnit\Framework\TestCase;
use Somnambulist\Components\Domain\Utils\IdentityGenerator;
use Somnambulist\Components\Domain\Utils\Tests\Assertions\AssertEntityHasPropertyWithValue;

/**
 * @group users
 * @group users-domain
 * @group users-domain-models
 */
class RoleTest extends TestCase
{
    use AssertEntityHasPropertyWithValue;
    use UseObjectFactoryHelper;

    public function testCreate()
    {
        $role = new Role(IdentityGenerator::random(), new RoleName('role'));

        $this->assertEntityHasPropertyWithValue($role, 'name', 'role');
    }

    public function testCanAddPermission()
    {
        $role = new Role(IdentityGenerator::random(), new RoleName('role'));
        $role->permissions()->grant($this->factory()->user->permission('perm'));

        $this->assertCount(1, $role->permissions());
    }

    public function testCanRemovePermission()
    {
        $role = new Role(IdentityGenerator::random(), new RoleName('role'));
        $role->permissions()->grant($p = $this->factory()->user->permission('perm'));
        $role->permissions()->revoke($p);

        $this->assertCount(0, $role->permissions());
    }

    public function testCanBatchAddPermissions()
    {
        $role = new Role(IdentityGenerator::random(), new RoleName('role'));
        $role->permissions()->grant(...$this->factory()->user->permission('perm', 'perm', 'perm'));

        $this->assertCount(3, $role->permissions());
    }

    public function testCanAddRole()
    {
        $role = new Role(IdentityGenerator::random(), new RoleName('role'));
        $role->roles()->grant($this->factory()->user->role());

        $this->assertCount(1, $role->roles());
    }

    public function testCanRemoveRole()
    {
        $role = new Role(IdentityGenerator::random(), new RoleName('role'));
        $role->roles()->grant($r = $this->factory()->user->role());
        $role->roles()->revoke($r);

        $this->assertCount(0, $role->permissions());
    }

    public function testCanBatchAddRoles()
    {
        $role = new Role(IdentityGenerator::random(), new RoleName('role'));
        $role->roles()->grant($this->factory()->user->role(), $this->factory()->user->role(), $this->factory()->user->role());

        $this->assertCount(3, $role->roles());
    }
}
