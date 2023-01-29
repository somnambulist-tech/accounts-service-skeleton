<?php declare(strict_types=1);

namespace App\Tests\Accounts\Delivery\Api\V1\Accounts;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\FixturesTrait;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Fixtures\AccountWithUserFixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group      accounts
 * @group      accounts-delivery
 * @group      accounts-delivery-api
 * @group      accounts-delivery-api-v1
 * @group      accounts-delivery-api-v1-accounts
 */
class ListAccountTest extends WebTestCase
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
        $res = $this->makeJsonRequestToNamedRoute('api.v1.accounts.search');

        $this->assertCount(2, $res['data']);
    }

    public function testPaginationParameters(): void
    {
        $res = $this->makeJsonRequestToNamedRoute('api.v1.accounts.search', [
            'per_page' => 1,
            'page'     => 1,
        ]);

        $pagination = $res['meta']['pagination'];

        $this->assertEquals(1, $pagination['per_page']);
        $this->assertEquals(1, $pagination['current_page']);
        $this->assertEquals(2, $pagination['total']);
        $this->assertEquals(2, $pagination['total_pages']);
    }

    public function testFindById(): void
    {
        $acc = AccountView::query()->fetchFirstOrFail();

        $res = $this->makeJsonRequestToNamedRoute('api.v1.accounts.search', [
            'filters' => ['id' => (string)$acc->id()],
        ]);

        $this->assertNotCount(0, $res['data']);
    }

    public function testFindByName(): void
    {
        $res = $this->makeJsonRequestToNamedRoute('api.v1.accounts.search', ['filters' => ['name' => 'name']]);

        $this->assertNotCount(0, $res['data']);
    }
}
