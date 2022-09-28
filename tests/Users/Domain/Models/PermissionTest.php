<?php declare(strict_types=1);

namespace App\Tests\Users\Domain\Models;

use App\Users\Domain\Models\Permission;
use App\Users\Domain\Models\PermissionName;
use PHPUnit\Framework\TestCase;

/**
 * @group users
 * @group users-domain
 * @group users-domain-models
 */
class PermissionTest extends TestCase
{
    public function testCreate()
    {
        $ent = new Permission(new PermissionName('permission'));

        $this->assertEquals('permission', $ent->name());
    }
}
