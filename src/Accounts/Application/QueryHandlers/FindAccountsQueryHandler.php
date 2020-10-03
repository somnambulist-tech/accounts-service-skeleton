<?php declare(strict_types=1);

namespace App\Accounts\Application\QueryHandlers;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Accounts\Domain\Queries\FindAccounts;

/**
 * Class FindAccountsQueryHandler
 *
 * @package    App\Accounts\Application\QueryHandlers
 * @subpackage App\Accounts\Application\QueryHandlers\FindAccountsQueryHandler
 */
class FindAccountsQueryHandler
{

    public function __invoke(FindAccounts $query)
    {
        $qb = AccountView::query();
        $qb->with($query->getIncludes());

        if ($query->getId()) {
            $qb->whereColumn('id', '=', $query->getId());
        }
        if ($query->getName()) {
            $qb->whereColumn('name', 'ILIKE', sprintf('%%%s%%', $query->getName()));
        }

        return $qb->paginate($query->getPage(), $query->getPerPage());
    }
}
