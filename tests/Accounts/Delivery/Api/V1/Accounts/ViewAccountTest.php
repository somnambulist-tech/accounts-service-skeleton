<?php declare(strict_types=1);

namespace App\Tests\Accounts\Delivery\Api\V1\Accounts;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\FixturesTrait;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Fixtures\AccountFixture;
use App\Tests\Support\Fixtures\AccountWithUserFixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group accounts
 * @group accounts-delivery
 * @group accounts-delivery-api
 * @group accounts-delivery-api-v1
 * @group accounts-delivery-api-v1-accounts
 */
class ViewAccountTest extends WebTestCase
{

    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function testView(): void
    {
        $this->loadFixtures([AccountFixture::class]);
        $acc = AccountView::query()->fetchFirstOrFail();

        $res = $this->makeJsonRequestToNamedRoute('api.v1.accounts.view', [
            'id' => $acc->id,
        ]);

        $this->assertArrayHasKey('id', $res);
    }

    public function testViewWithIncludedUsers(): void
    {
        $this->loadFixtures([AccountWithUserFixture::class]);
        $acc = AccountView::query()->fetchFirstOrFail();

        $res = $this->makeJsonRequestToNamedRoute('api.v1.accounts.view', [
            'id'      => $acc->id,
            'include' => 'users',
        ]);

        $this->assertNotEmpty($res['users']);
    }
}
