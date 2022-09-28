<?php declare(strict_types=1);

namespace App\Tests\Accounts\Delivery\Api\V1\Accounts;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\FixturesTrait;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Fixtures\AccountFixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group      accounts
 * @group      accounts-delivery
 * @group      accounts-delivery-api
 * @group      accounts-delivery-api-v1
 * @group      accounts-delivery-api-v1-accounts
 */
class ActivationTest extends WebTestCase
{

    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function setUpTests(): void
    {
        $this->loadFixtures([AccountFixture::class]);
    }

    public function testCanActivate(): void
    {
        $model = AccountView::query()->fetchFirstOrFail();

        $res = $this->makeJsonRequestToNamedRoute(
            'api.v1.accounts.activate',
            ['id' => $model->id()],
            'POST',
            [],
            200
        );

        $this->assertArrayHasKey('id', $res);
        $this->assertTrue($res['active']);
    }

    public function testCanDeactivate(): void
    {
        $model = AccountView::query()->fetchFirstOrFail();

        $res = $this->makeJsonRequestToNamedRoute(
            'api.v1.accounts.activate',
            ['id' => $model->id()],
            'POST',
            [],
            200
        );

        $this->assertTrue($res['active']);

        $res = $this->makeJsonRequestToNamedRoute(
            'api.v1.accounts.deactivate',
            ['id' => $model->id()],
            'POST',
            [],
            200
        );

        $this->assertFalse($res['active']);
    }
}
