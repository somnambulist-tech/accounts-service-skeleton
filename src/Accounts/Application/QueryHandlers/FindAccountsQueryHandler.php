<?php declare(strict_types=1);

namespace App\Accounts\Application\QueryHandlers;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Accounts\Domain\Queries\FindAccounts;
use App\Resources\Application\QueryHandlers\Behaviours\CanApplyOrderToQuery;

/**
 * Class FindAccountsQueryHandler
 *
 * @package    App\Accounts\Application\QueryHandlers
 * @subpackage App\Accounts\Application\QueryHandlers\FindAccountsQueryHandler
 */
class FindAccountsQueryHandler
{

    use CanApplyOrderToQuery;

    private array $availableOrderFields = ['id', 'name', 'created_at', 'updated_at'];

    public function __invoke(FindAccounts $query)
    {
        $qb = AccountView::query();
        $qb->with(...$query->getIncludes());

        $this->applySortCriteria($qb, $query, 'name', 'ASC');

        if ($query->getId()) {
            $qb->whereColumn('id', '=', $query->getId());
        }
        if ($query->getName()) {
            $qb->whereColumn('name', 'ILIKE', sprintf('%%%s%%', $query->getName()));
        }

        return $qb->paginate($query->getPage(), $query->getPerPage());
    }
}
