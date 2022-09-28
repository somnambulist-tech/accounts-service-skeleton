<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\EntityLocators;

use App\Users\Domain\Models\User;
use Somnambulist\Components\Doctrine\AbstractModelLocator;
use Somnambulist\Components\Models\Types\Identity\Uuid;

/**
 * @method User find($id, $lockMode = null, $lockVersion = null)
 * @method User findOrFail($id)
 * @method User findOneBy(array $criteria, array $orderBy = null)
 * @method User findOneByOrFail(array $criteria, array $orderBy = null)
 * @method User findOrFailByUUID(Uuid $uuid)
 */
class UserLocator extends AbstractModelLocator
{
    protected function getEntityUuidFieldName(): string
    {
        return 'id';
    }
}
