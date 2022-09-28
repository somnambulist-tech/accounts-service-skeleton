<?php declare(strict_types=1);

namespace App\Tests\Users\Delivery\Api\V1\Users;

use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\FixturesTrait;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Behaviours\UseObjectFactoryHelper;
use App\Tests\Support\Fixtures\AccountWithUserFixture;
use App\Users\Delivery\ViewModels\UserView;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group      users
 * @group      users-delivery
 * @group      users-delivery-api
 * @group      users-delivery-api-v1-users
 */
class ChangeAuthCredsTest extends WebTestCase
{
    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;
    use UseObjectFactoryHelper;

    public function setUpTests(): void
    {
        $this->loadFixtures([AccountWithUserFixture::class]);
    }

    public function testChangeCreds(): void
    {
        $user = UserView::query()->fetchFirstOrFail();

        $password = $this->factory()->user->password();
        $res      = $this->changeCreds($user, $user->email(), (string)$password);

        $this->assertSame($user->email, $res['email']);
        $this->assertSame((string)$password, $res['password']);
    }

    public function testCannotOverwriteExistingEmailAddress(): void
    {
        $user  = UserView::query()->fetchFirstOrFail();
        $other = UserView::query()->whereColumn('email', '!=', $user->email())->fetchFirstOrFail();

        $res = $this->changeCreds($user, $other->email(), $user->password(), 422);

        $this->assertNotEmpty($res['errors']['email']);
    }

    protected function changeCreds(UserView $user, string $email, string $password, int $expectedStatusCode = 200): ?array
    {
        return $this->makeJsonRequestToNamedRoute(
            'api.v1.users.change_auth_credentials',
            ['id' => $user->id()],
            'PUT',
            ['email' => (string)$email, 'password' => (string)$password],
            $expectedStatusCode
        );
    }
}
