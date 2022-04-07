<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\EntityLocators;

use App\Users\Domain\Models\Permission;
use Somnambulist\Components\Domain\Doctrine\AbstractEntityLocator;

/**
 * Class PermissionLocator
 *
 * @package    App\Users\Infrastructure\Persistence\EntityLocators
 * @subpackage App\Users\Infrastructure\Persistence\EntityLocators\PermissionLocator
 *
 * @method Permission find($id, $lockMode = null, $lockVersion = null)
 * @method Permission findOrFail($id)
 * @method Permission findOneBy(array $criteria, array $orderBy = null)
 * @method Permission findOneByOrFail(array $criteria, array $orderBy = null)
 */
class PermissionLocator extends AbstractEntityLocator
{
    protected function getEntityUuidFieldName(): string
    {
        return 'id';
    }
}
