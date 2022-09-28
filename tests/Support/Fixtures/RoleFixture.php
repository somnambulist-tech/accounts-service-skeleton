<?php declare(strict_types=1);

namespace App\Tests\Support\Fixtures;

use App\Tests\Support\Behaviours\UseObjectFactoryHelper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixture extends Fixture
{
    use UseObjectFactoryHelper;

    public function load(ObjectManager $manager)
    {
        foreach (['user', 'root', 'admin', 'role 1', 'role 2', 'role 3'] as $role) {
            $entity = $this->factory()->user->role($role);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
