<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\EntityLocators;

use App\Users\Domain\Models\Role;
use Somnambulist\Components\Doctrine\AbstractModelLocator;

/**
 * @method Role find($id, $lockMode = null, $lockVersion = null)
 * @method Role findOrFail($id)
 * @method Role findOneBy(array $criteria, array $orderBy = null)
 * @method Role findOneByOrFail(array $criteria, array $orderBy = null)
 */
class RoleLocator extends AbstractModelLocator
{
    protected function getEntityUuidFieldName(): string
    {
        return 'id';
    }
}
