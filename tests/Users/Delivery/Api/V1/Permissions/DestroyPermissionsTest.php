<?php declare(strict_types=1);

namespace App\Tests\Users\Delivery\Api\V1\Permissions;

use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group      users
 * @group      users-delivery
 * @group      users-delivery-api
 * @group      users-delivery-api-v1-permissions
 */
class DestroyPermissionsTest extends WebTestCase
{
    use BootTestClient;
    use MakeJsonRequestTo;

    public function testDestroy()
    {
        $this->makeJsonRequestToNamedRoute('api.v1.permissions.create', [], 'POST', ['name' => 'my-permission'], 201);

        $this->makeJsonRequestToNamedRoute('api.v1.permissions.destroy', ['id' => 'my-permission'], 'DELETE', [], 204);
    }
}
