<?php declare(strict_types=1);

namespace App\Tests\Accounts\Delivery\Api\V1\Accounts;

use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\FixturesTrait;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Tests\Support\Fixtures\AccountWithUserFixture;
use Somnambulist\Components\Domain\Utils\IdentityGenerator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group      accounts
 * @group      accounts-delivery
 * @group      accounts-delivery-api
 * @group      accounts-delivery-api-v1
 * @group      accounts-delivery-api-v1-accounts
 */
class CreateAccountTest extends WebTestCase
{

    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function setUpTests(): void
    {
        $this->loadFixtures([AccountWithUserFixture::class]);
    }

    public function testCreate(): void
    {
        $res = $this->create([
            'id'   => IdentityGenerator::random()->toString(),
            'name' => 'test',
        ], 201);

        $this->assertArrayHasKey('id', $res);
    }

    protected function create(array $body, int $expectedStatusCode = 200): ?array
    {
        return $this->makeJsonRequestToNamedRoute('api.v1.accounts.create', [], 'POST', $body, $expectedStatusCode);
    }
}
