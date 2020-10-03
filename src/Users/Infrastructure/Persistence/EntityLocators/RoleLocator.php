<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\EntityLocators;

use App\Users\Domain\Models\Role;
use Somnambulist\Domain\Doctrine\AbstractEntityLocator;

/**
 * Class RoleLocator
 *
 * @package    App\Users\Infrastructure\Persistence\EntityLocators
 * @subpackage App\Users\Infrastructure\Persistence\EntityLocators\RoleLocator
 *
 * @method Role find($id, $lockMode = null, $lockVersion = null)
 * @method Role findOrFail($id)
 * @method Role findOneBy(array $criteria, array $orderBy = null)
 * @method Role findOneByOrFail(array $criteria, array $orderBy = null)
 */
class RoleLocator extends AbstractEntityLocator
{
    protected function getEntityUuidFieldName(): string
    {
        return 'id';
    }
}
