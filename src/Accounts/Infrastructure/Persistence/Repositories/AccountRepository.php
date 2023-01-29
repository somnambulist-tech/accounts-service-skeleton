<?php declare(strict_types=1);

namespace App\Accounts\Infrastructure\Persistence\Repositories;

use App\Accounts\Domain\Models\Account;
use App\Accounts\Domain\Services\Repositories\AccountRepository as AccountRepositoryContract;
use App\Accounts\Infrastructure\Persistence\EntityLocators\AccountLocator;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class AccountRepository implements AccountRepositoryContract
{
    private ObjectManager $em;

    public function __construct(ManagerRegistry $registry)
    {
        $this->em = $registry->getManager();
    }
    
    public function find(Uuid $id): Account
    {
        return $this->repo()->findOrFail($id);
    }

    public function store(Account $account): void
    {
        $this->em->persist($account);
        $this->em->flush();
    }

    public function destroy(Account $account): void
    {
        $this->em->remove($account);
        $this->em->flush();
    }

    private function repo(): AccountLocator
    {
        return $this->em->getRepository(Account::class);
    }
}
