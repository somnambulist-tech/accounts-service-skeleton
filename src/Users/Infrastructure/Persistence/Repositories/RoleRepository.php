<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Repositories;

use App\Users\Domain\Models\Name;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Services\Repositories\RoleRepository as RoleRepositoryContract;
use App\Users\Infrastructure\Persistence\EntityLocators\RoleLocator;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Class RoleRepository
 *
 * @package    App\Users\Infrastructure\Persistence\Repositories
 * @subpackage App\Users\Infrastructure\Persistence\Repositories\RoleRepository
 */
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
        return $this->repo()->findOneByOrFail(['name' => new Name($name)]);
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
