<?php declare(strict_types=1);

namespace App\Tests\Users\Delivery\Api\V1\Roles;

use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\FixturesTrait;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Fixtures\RoleFixture;
use App\Users\Delivery\ViewModels\RoleView;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group      users
 * @group      users-delivery
 * @group      users-delivery-api
 * @group      users-delivery-api-v1-roles
 */
class ViewRoleTest extends WebTestCase
{
    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function testView(): void
    {
        $this->loadFixtures([RoleFixture::class]);

        $user = RoleView::query()->fetchFirstOrFail();
        $res  = $this->makeJsonRequestToNamedRoute('api.v1.roles.view', ['id' => $user->id()]);

        $this->assertArrayHasKey('id', $res);
        $this->assertArrayHasKey('name', $res);
        $this->assertArrayHasKey('created_at', $res);
        $this->assertArrayHasKey('updated_at', $res);
    }
}
