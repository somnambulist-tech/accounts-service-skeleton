<?php declare(strict_types=1);

namespace App\Tests\Support\Fixtures;

use App\Tests\Support\Behaviours\UseObjectFactoryHelper;
use App\Users\Domain\Models\Name;
use App\Users\Domain\Models\Permission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class RoleWithPermissionFixture
 *
 * @package    App\Tests\Support\Fixtures
 * @subpackage App\Tests\Support\Fixtures\RoleWithPermissionFixture
 */
class RoleWithPermissionFixture extends Fixture
{
    use UseObjectFactoryHelper;

    public function load(ObjectManager $manager)
    {
        $permissions = [
            'admin.users.manage',
            'admin.users.destroy',
            'admin.accounts.manage',
            'admin.accounts.destroy',
            'admin.roles.manage',
            'admin.roles.destroy',
        ];

        foreach (['user', 'root', 'admin'] as $role) {
            $entity = $this->factory->user->role($role);
            $manager->persist($entity);

            if ($role === 'root') {
                foreach ($permissions as $permission) {
                    $entity->permissions()->grant(new Permission(new Name($permission)));
                }
            }
        }

        $manager->flush();
    }
}
