<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Repositories;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use App\Users\Domain\Models\User;
use App\Users\Domain\Services\Repositories\UserRepository as UserRepositoryContract;
use App\Users\Infrastructure\Persistence\EntityLocators\UserLocator;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Class UserRepository
 *
 * @package    App\Users\Infrastructure\Persistence\Repositories
 * @subpackage App\Users\Infrastructure\Persistence\Repositories\UserRepository
 */
class UserRepository implements UserRepositoryContract
{

    private ObjectManager $em;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManager();
    }
    
    public function find(Uuid $id): User
    {
        return $this->repo()->findOrFailByUUID($id);
    }

    public function store(User $user): bool
    {
        $this->em->persist($user);

        return true;
    }

    public function destroy(User $user): bool
    {
        $this->em->remove($user);

        return true;
    }

    private function repo(): UserLocator
    {
        return $this->em->getRepository(User::class);
    }
}
