<?php declare(strict_types=1);

namespace App\Tests\Users\Delivery\Api\V1\Users;

use App\Accounts\Delivery\ViewModels\AccountView;
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
class UpdateAccountTest extends WebTestCase
{
    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function setUpTests(): void
    {
        $this->loadFixtures([AccountWithUserFixture::class]);
    }

    public function testUpdateAccount(): void
    {
        $acc = AccountView::query()->fetchFirstOrFail();

        $res = $this->changeAccount((string)$acc->id());

        $this->assertArrayHasKey('id', $res);
    }

    public function testUpdateAccountWithBadAccountIdReturnsJsonError(): void
    {
        $res = $this->changeAccount('notAnId', 400);

        $this->assertNotEmpty($res['errors']['account_id']);
    }

    protected function changeAccount(string $id, int $expectedStatusCode = 200): ?array
    {
        $user = UserView::query()->fetchFirstOrFail();

        return $this->makeJsonRequestToNamedRoute(
            'api.v1.users.change_account',
            ['id' => $user->id()],
            'PUT',
            ['account_id' => $id],
            $expectedStatusCode
        );
    }
}
