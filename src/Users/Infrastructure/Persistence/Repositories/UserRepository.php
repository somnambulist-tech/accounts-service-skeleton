<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Repositories;

use App\Users\Domain\Models\User;
use App\Users\Domain\Services\Repositories\UserRepository as UserRepositoryContract;
use App\Users\Infrastructure\Persistence\EntityLocators\UserLocator;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class UserRepository implements UserRepositoryContract
{
    private ObjectManager $em;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManager();
    }
    
    public function find(Uuid $id): User
    {
        return $this->repo()->findOrFail($id);
    }

    public function store(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    public function destroy(User $user): void
    {
        $this->em->remove($user);
        $this->em->flush();
    }

    private function repo(): UserLocator
    {
        return $this->em->getRepository(User::class);
    }
}
