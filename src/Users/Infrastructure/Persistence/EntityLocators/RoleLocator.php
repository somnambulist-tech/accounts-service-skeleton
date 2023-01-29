<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\EntityLocators;

use App\Users\Domain\Models\Role;
use Doctrine\Persistence\ManagerRegistry;
use Somnambulist\Components\Doctrine\AbstractServiceModelLocator;

/**
 * @method Role find($id, $lockMode = null, $lockVersion = null)
 * @method Role findOrFail($id)
 * @method Role findOneBy(array $criteria, array $orderBy = null)
 * @method Role findOneByOrFail(array $criteria, array $orderBy = null)
 */
class RoleLocator extends AbstractServiceModelLocator
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }

    protected function getEntityUuidFieldName(): string
    {
        return 'id';
    }
}
