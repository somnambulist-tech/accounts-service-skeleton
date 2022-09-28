<?php declare(strict_types=1);

namespace App\Tests\Accounts\Delivery\Api\V1\Accounts;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\DoctrineHelper;
use App\Tests\Support\Behaviours\FixturesTrait;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Fixtures\AccountFixture;
use App\Tests\Support\Fixtures\AccountWithUserFixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group      accounts
 * @group      accounts-delivery
 * @group      accounts-delivery-api
 * @group      accounts-delivery-api-v1
 * @group      accounts-delivery-api-v1-accounts
 */
class DestroyAccountTest extends WebTestCase
{
    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;
    use DoctrineHelper;

    public function testDestroy(): void
    {
        $this->loadFixtures([AccountFixture::class]);

        $this->destroyFirst(204);
    }

    public function testDestroyReturnsErrorWhenAccountHasUsers(): void
    {
        $this->loadFixtures([AccountWithUserFixture::class]);

        $res = $this->destroyFirst(422);

        $this->assertNotEmpty($res['message']);
        $this->assertArrayHasKey('errors', $res);
    }

    protected function destroyFirst(int $expectedStatusCode = 200): ?array
    {
        $acc = AccountView::query()->fetchFirstOrFail();

        return $this->makeJsonRequestToNamedRoute(
            'api.v1.accounts.destroy',
            ['id' => (string)$acc->id()],
            'DELETE',
            [],
            $expectedStatusCode
        );
    }
}
