<?php declare(strict_types=1);

namespace App\Tests\Accounts\Delivery\Api\V1\Accounts;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Fixtures\AccountFixture;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ChangeAccountNameTest
 *
 * @package    App\Tests\Accounts\Delivery\Api\V1\Accounts
 * @subpackage App\Tests\Accounts\Delivery\Api\V1\Accounts\ChangeAccountNameTest
 *
 * @group      accounts
 * @group      accounts-delivery
 * @group      accounts-delivery-api
 * @group      accounts-delivery-api-v1
 * @group      accounts-delivery-api-v1-accounts
 */
class ChangeAccountNameTest extends WebTestCase
{

    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function setUpTests(): void
    {
        $this->loadFixtures([AccountFixture::class]);
    }

    public function testChangeName(): void
    {
        $res = $this->update([
            'name' => 'test test',
        ]);

        $this->assertSame('test test', $res['name']);
    }

    /**
     * @group cur
     */
    public function testUpdateWithNoNameReturnsJsonError(): void
    {
        $res = $this->update([
            'name' => '',
        ], 400);

        $this->assertNotEmpty($res['errors']['name']);
    }

    protected function update(array $body, int $expectedStatusCode = 200): ?array
    {
        $acc = AccountView::query()->fetchFirstOrFail();

        return $this->makeJsonRequestToNamedRoute(
            'api.v1.accounts.change_name',
            ['id' => $acc->id()],
            'PUT',
            $body,
            $expectedStatusCode
        );
    }
}
