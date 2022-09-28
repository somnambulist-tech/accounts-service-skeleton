<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Repositories;

use App\Users\Domain\Models\Role;
use App\Users\Domain\Services\Repositories\RoleRepository as RoleRepositoryContract;
use App\Users\Infrastructure\Persistence\EntityLocators\RoleLocator;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class RoleRepository implements RoleRepositoryContract
{
    private ObjectManager $em;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManager();
    }
    
    public function find(Uuid $id): Role
    {
        return $this->repo()->findOrFail($id);
    }

    public function findByName(string $name): Role
    {
        return $this->repo()->findOneByOrFail(['name' => $name]);
    }

    public function store(Role $role): bool
    {
        $this->em->persist($role);

        return true;
    }

    public function destroy(Role $role): bool
    {
        $this->em->remove($role);

        return true;
    }

    private function repo(): RoleLocator
    {
        return $this->em->getRepository(Role::class);
    }
}
