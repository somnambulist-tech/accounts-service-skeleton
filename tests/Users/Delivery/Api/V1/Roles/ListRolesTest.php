<?php declare(strict_types=1);

namespace App\Tests\Users\Delivery\Api\V1\Roles;

use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\FixturesTrait;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Fixtures\RoleFixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group users
 * @group users-delivery
 * @group users-delivery-api
 * @group users-delivery-api-v1-roles
 */
class ListRolesTest extends WebTestCase
{
    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function testList()
    {
        $this->loadFixtures([RoleFixture::class]);

        $results = $this->makeJsonRequestToNamedRoute('api.v1.roles.list');

        $this->assertNotCount(0, $results['data']);
    }
}
