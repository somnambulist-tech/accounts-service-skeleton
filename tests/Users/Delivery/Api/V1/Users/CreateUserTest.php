<?php declare(strict_types=1);

namespace App\Tests\Users\Delivery\Api\V1\Users;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\FixturesTrait;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Behaviours\UseObjectFactoryHelper;
use App\Tests\Support\Fixtures\AccountWithUserFixture;
use App\Tests\Support\Fixtures\RoleFixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group users
 * @group users-delivery
 * @group users-delivery-api
 * @group users-delivery-api-v1-users
 */
class CreateUserTest extends WebTestCase
{
    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;
    use UseObjectFactoryHelper;

    public function setUpTests(): void
    {
        $this->loadFixtures([AccountWithUserFixture::class, RoleFixture::class]);
    }

    public function testCreate(): void
    {
        $acc = AccountView::query()->fetchFirstOrFail();

        $res = $this->create([
            'account_id' => (string)$acc->id(),
            'email'      => 'test@test.com',
            'password'   => (string)$this->factory()->user->password(),
            'name'       => $this->factory()->faker->name,
        ], 201);

        $this->assertArrayHasKey('id', $res);
    }

    public function testCreateWithBadPasswordReturnsJsonError(): void
    {
        $acc = AccountView::query()->fetchFirstOrFail();

        $res = $this->create([
            'account_id' => (string)$acc->id(),
            'email'      => 'test@test.com',
            'password'   => 'notHashed',
            'name'       => $this->factory()->faker->name,
        ], 422);

        $this->assertNotEmpty($res['errors']['password']);
    }

    protected function create(array $body, int $expectedStatusCode = 200): ?array
    {
        return $this->makeJsonRequestToNamedRoute("api.v1.users.create", [], 'POST', $body, $expectedStatusCode);
    }
}
