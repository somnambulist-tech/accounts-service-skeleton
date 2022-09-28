<?php declare(strict_types=1);

namespace App\Tests\Users\Delivery\Api\V1\Users;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\FixturesTrait;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Fixtures\AccountWithUserFixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group      users
 * @group      users-delivery
 * @group      users-delivery-api
 * @group      users-delivery-api-v1-users
 */
class ListUserTest extends WebTestCase
{
    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function setUpTests(): void
    {
        $this->loadFixtures([AccountWithUserFixture::class]);
    }

    public function testList(): void
    {
        $acc = AccountView::query()->fetchFirstOrFail();

        $res = $this->makeJsonRequestToNamedRoute('api.v1.users.list', [
            'account_id' => (string)$acc->id(),
        ]);

        $this->assertCount(2, $res['data']);
    }
}
