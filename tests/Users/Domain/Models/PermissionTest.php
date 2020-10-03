<?php declare(strict_types=1);

namespace App\Tests\Users\Domain\Models;

use App\Users\Domain\Models\Name;
use App\Users\Domain\Models\Permission;
use PHPUnit\Framework\TestCase;

/**
 * Class PermissionTest
 *
 * @package    App\Tests\Users\Domain\Models
 * @subpackage App\Tests\Users\Domain\Models\PermissionTest
 *
 * @group users
 * @group users-domain
 * @group users-domain-models
 */
class PermissionTest extends TestCase
{

    public function testCreate()
    {
        $ent = new Permission(new Name('permission'));

        $this->assertEquals('permission', $ent->name());
    }
}
