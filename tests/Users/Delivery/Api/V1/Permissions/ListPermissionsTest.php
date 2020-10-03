<?php declare(strict_types=1);

namespace App\Tests\Users\Delivery\Api\V1\Permissions;

use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Fixtures\RoleWithPermissionFixture;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ListPermissionsTest
 *
 * @package    App\Tests\Users\Delivery\Api\V1\Permissions
 * @subpackage App\Tests\Users\Delivery\Api\V1\Permissions\ListPermissionsTest
 *
 * @group      users
 * @group      users-delivery
 * @group      users-delivery-api
 * @group      users-delivery-api-v1-permissions
 */
class ListPermissionsTest extends WebTestCase
{

    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function testList()
    {
        $this->loadFixtures([RoleWithPermissionFixture::class]);

        $results = $this->makeJsonRequestToNamedRoute('api.v1.permissions.list');

        $this->assertNotCount(0, $results['data']);
    }
}
