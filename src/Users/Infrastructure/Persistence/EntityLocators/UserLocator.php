<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\EntityLocators;

use App\Users\Domain\Models\User;
use Somnambulist\Domain\Doctrine\AbstractEntityLocator;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Class UserLocator
 *
 * @package    App\Users\Infrastructure\Persistence\EntityLocators
 * @subpackage App\Users\Infrastructure\Persistence\EntityLocators\UserLocator
 *
 * @method User find($id, $lockMode = null, $lockVersion = null)
 * @method User findOrFail($id)
 * @method User findOneBy(array $criteria, array $orderBy = null)
 * @method User findOneByOrFail(array $criteria, array $orderBy = null)
 * @method User findOrFailByUUID(Uuid $uuid)
 */
class UserLocator extends AbstractEntityLocator
{
    protected function getEntityUuidFieldName(): string
    {
        return 'id';
    }
}
