<?php declare(strict_types=1);

namespace App\Tests\Users\Delivery\Api\V1\Roles;

use App\Tests\Support\Behaviours\BootTestClient;
use App\Tests\Support\Behaviours\FixturesTrait;
use App\Tests\Support\Behaviours\MakeJsonRequestTo;
use App\Users\Delivery\ViewModels\RoleView;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group      users
 * @group      users-delivery
 * @group      users-delivery-api
 * @group      users-delivery-api-v1-roles
 */
class DestroyRoleTest extends WebTestCase
{
    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function testDestroy(): void
    {
        $res = $this->makeJsonRequestToNamedRoute('api.v1.roles.create', [], 'POST', ['name' => 'my_role'], 201);

        $this->makeJsonRequestToNamedRoute('api.v1.roles.destroy', ['id' => $res['id']], 'DELETE', [], 204);
    }

    public function testDestroyRaisesExceptionOnReservedRoles(): void
    {
        if (null === $root = RoleView::query()->whereColumn('name', '=', 'root')->fetchFirstOrNull()) {
            $root = (object)$this->makeJsonRequestToNamedRoute('api.v1.roles.create', [], 'POST', ['name' => 'root'], 201);
        }

        $this->makeJsonRequestToNamedRoute('api.v1.roles.destroy', ['id' => $root->id], 'DELETE', [], 400);
    }
}
