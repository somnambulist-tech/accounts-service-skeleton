<?php declare(strict_types=1);

namespace App\Accounts\Application\QueryHandlers;

use App\Accounts\Domain\Queries\CountUsersOnAccount;
use App\Users\Delivery\ViewModels\UserView;

/**
 * Class CountUsersAssociatedWithAccountQueryHandler
 *
 * @package    App\Accounts\Application\QueryHandlers
 * @subpackage App\Accounts\Application\QueryHandlers\CountUsersAssociatedWithAccountQueryHandler
 */
class CountUsersOnAccountQueryHandler
{
    public function __invoke(CountUsersOnAccount $query): int
    {
        return UserView::query()->whereColumn('account_id', '=', $query->getId())->count();
    }
}
