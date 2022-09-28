<?php declare(strict_types=1);

namespace App\Tests\Users\Delivery\Api\V1\Users;

use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\FixturesTrait;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Fixtures\AccountWithUserFixture;
use App\Users\Delivery\ViewModels\UserView;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group      users
 * @group      users-delivery
 * @group      users-delivery-api
 * @group      users-delivery-api-v1-users
 */
class ActivationTest extends WebTestCase
{
    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function setUpTests(): void
    {
        $this->loadFixtures([AccountWithUserFixture::class]);
    }

    public function testCanActivateUser(): void
    {
        $user = UserView::query()->fetchFirstOrFail();

        $res = $this->makeJsonRequestToNamedRoute(
            'api.v1.users.activate',
            ['id' => $user->id()],
            'POST',
            [],
            200
        );

        $this->assertArrayHasKey('id', $res);
        $this->assertTrue($res['active']);
    }

    public function testCanDeactivateUser(): void
    {
        $user = UserView::query()->fetchFirstOrFail();

        $res = $this->makeJsonRequestToNamedRoute(
            'api.v1.users.activate',
            ['id' => $user->id()],
            'POST',
            [],
            200
        );

        $this->assertTrue($res['active']);

        $res = $this->makeJsonRequestToNamedRoute(
            'api.v1.users.deactivate',
            ['id' => $user->id()],
            'POST',
            [],
            200
        );

        $this->assertFalse($res['active']);
    }
}
