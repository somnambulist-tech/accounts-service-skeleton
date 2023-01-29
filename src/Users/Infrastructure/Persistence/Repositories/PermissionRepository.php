<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Repositories;

use App\Users\Domain\Models\Permission;
use App\Users\Domain\Services\Repositories\PermissionRepository as PermissionRepositoryContract;
use App\Users\Infrastructure\Persistence\EntityLocators\PermissionLocator;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class PermissionRepository implements PermissionRepositoryContract
{
    private ObjectManager $em;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManager();
    }
    
    public function find($id): Permission
    {
        return $this->repo()->findOrFail($id);
    }

    public function findByName(string $name): Permission
    {
        return $this->repo()->findOneByOrFail(['name' => $name]);
    }

    public function store(Permission $permission): void
    {
        $this->em->persist($permission);
        $this->em->flush();
    }

    public function destroy(Permission $permission): void
    {
        $this->em->remove($permission);
        $this->em->flush();
    }

    private function repo(): PermissionLocator
    {
        return $this->em->getRepository(Permission::class);
    }
}
