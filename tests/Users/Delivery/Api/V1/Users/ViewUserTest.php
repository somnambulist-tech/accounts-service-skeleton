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
class ViewUserTest extends WebTestCase
{
    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function testView(): void
    {
        $this->loadFixtures([AccountWithUserFixture::class]);

        $user = UserView::query()->fetchFirstOrFail();
        $res  = $this->makeJsonRequestToNamedRoute('api.v1.users.view', ['id' => $user->id()]);

        $this->assertArrayHasKey('id', $res);
    }
}
