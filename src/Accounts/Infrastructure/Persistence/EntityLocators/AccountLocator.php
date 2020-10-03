<?php declare(strict_types=1);

namespace App\Accounts\Infrastructure\Persistence\EntityLocators;

use App\Accounts\Domain\Models\Account;
use Somnambulist\Domain\Doctrine\AbstractEntityLocator;

/**
 * Class AccountLocator
 *
 * @package    App\Accounts\Infrastructure\Persistence\EntityLocators
 * @subpackage App\Accounts\Infrastructure\Persistence\EntityLocators\AccountLocator
 *
 * @method Account find($id, $lockMode = null, $lockVersion = null)
 * @method Account findOrFail($id)
 * @method Account findOneBy(array $criteria, array $orderBy = null)
 * @method Account findOneByOrFail(array $criteria, array $orderBy = null)
 */
class AccountLocator extends AbstractEntityLocator
{

    protected function getEntityUuidFieldName(): string
    {
        return 'id';
    }
}
