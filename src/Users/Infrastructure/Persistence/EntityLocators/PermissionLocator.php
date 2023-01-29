<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\EntityLocators;

use App\Users\Domain\Models\Permission;
use Doctrine\Persistence\ManagerRegistry;
use Somnambulist\Components\Doctrine\AbstractServiceModelLocator;

/**
 * @method Permission find($id, $lockMode = null, $lockVersion = null)
 * @method Permission findOrFail($id)
 * @method Permission findOneBy(array $criteria, array $orderBy = null)
 * @method Permission findOneByOrFail(array $criteria, array $orderBy = null)
 */
class PermissionLocator extends AbstractServiceModelLocator
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Permission::class);
    }

    protected function getEntityUuidFieldName(): string
    {
        return 'id';
    }
}
