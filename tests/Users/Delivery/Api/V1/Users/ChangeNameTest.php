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
class ChangeNameTest extends WebTestCase
{
    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function setUpTests(): void
    {
        $this->loadFixtures([AccountWithUserFixture::class]);
    }

    public function testChangeName(): void
    {
        $res = $this->changeName('test@test.com');

        $this->assertArrayHasKey('id', $res);
        $this->assertEquals('test@test.com', $res['name']);
    }

    public function testNameCannotBeEmpty(): void
    {
        $res = $this->changeName('', 400);

        $this->assertNotEmpty($res['errors']['name']);
    }

    protected function changeName(string $name, int $expectedStatusCode = 200): ?array
    {
        $user = UserView::query()->fetchFirstOrFail();

        return $this->makeJsonRequestToNamedRoute(
            'api.v1.users.change_name',
            ['id' => $user->id()],
            'PUT',
            ['name' => $name],
            $expectedStatusCode
        );
    }
}
