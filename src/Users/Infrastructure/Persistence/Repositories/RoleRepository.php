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

    public function store(Role $role): void
    {
        $this->em->persist($role);
        $this->em->flush();
    }
    
    public function destroy(Role $role): void
    {
        $this->em->remove($role);
        $this->em->flush();
    }

    private function repo(): RoleLocator
    {
        return $this->em->getRepository(Role::class);
    }
}
