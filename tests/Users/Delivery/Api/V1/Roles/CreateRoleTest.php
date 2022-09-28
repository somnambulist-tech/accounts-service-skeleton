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
class CreateRoleTest extends WebTestCase
{
    use BootTestClient;
    use FixturesTrait;
    use MakeJsonRequestTo;

    public function testCreate(): void
    {
        $res = $this->makeJsonRequestToNamedRoute('api.v1.roles.create', [], 'POST', ['name' => 'my_role'], 201);

        $this->assertArrayHasKey('id', $res);
        $this->assertArrayHasKey('name', $res);
        $this->assertArrayHasKey('created_at', $res);
        $this->assertArrayHasKey('updated_at', $res);
    }

    public function testCreateWithRolesAndPermissions(): void
    {
        $user  = RoleView::query()->whereColumn('name', '=', 'user')->fetchFirstOrFail();
        $admin = RoleView::query()->whereColumn('name', '=', 'admin')->fetchFirstOrFail();

        $res = $this->makeJsonRequestToNamedRoute(
            'api.v1.roles.create',
            [],
            'POST',
            [
                'name' => 'my_role',
                'roles' => [
                    (string)$user->id,
                    (string)$admin->id,
                ],
                'permissions' => [
                    'can do this',
                    'can do that',
                    'some other thing',
                ]
            ],
            201
        );

        $this->assertArrayHasKey('id', $res);
        $this->assertArrayHasKey('name', $res);
        $this->assertArrayHasKey('created_at', $res);
        $this->assertArrayHasKey('updated_at', $res);
        $this->assertArrayHasKey('roles', $res);
        $this->assertArrayHasKey('permissions', $res);
        $this->assertCount(2, $res['roles']);
        $this->assertCount(3, $res['permissions']);
    }
}
