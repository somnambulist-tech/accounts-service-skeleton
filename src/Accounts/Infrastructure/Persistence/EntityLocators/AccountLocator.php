<?php declare(strict_types=1);

namespace App\Accounts\Infrastructure\Persistence\EntityLocators;

use App\Accounts\Domain\Models\Account;
use Doctrine\Persistence\ManagerRegistry;
use Somnambulist\Components\Doctrine\AbstractServiceModelLocator;

/**
 * @method Account find($id, $lockMode = null, $lockVersion = null)
 * @method Account findOrFail($id)
 * @method Account findOneBy(array $criteria, array $orderBy = null)
 * @method Account findOneByOrFail(array $criteria, array $orderBy = null)
 */
class AccountLocator extends AbstractServiceModelLocator
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    protected function getEntityUuidFieldName(): string
    {
        return 'id';
    }
}
