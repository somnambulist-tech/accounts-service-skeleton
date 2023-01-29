<?php declare(strict_types=1);

namespace App\Accounts\Application\QueryHandlers;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Accounts\Domain\Queries\FindAccounts;
use App\Resources\Application\QueryHandlers\Behaviours\CanApplyOrderToQuery;
use Pagerfanta\Pagerfanta;
use Somnambulist\Bundles\ApiBundle\Request\Filters\ApplyApiExpressionsToDBALQueryBuilder;

class FindAccountsQueryHandler
{
    use CanApplyOrderToQuery;

    private array $availableOrderFields = ['id', 'name', 'created_at', 'updated_at'];

    public function __invoke(FindAccounts $query): Pagerfanta
    {
        $qb = AccountView::query();
        $qb->include(...$query->includes());

        $this->applySortCriteria($qb, $query, 'name');

        $mapper = new ApplyApiExpressionsToDBALQueryBuilder([
            'id'   => 'a.id',
            'name' => 'a.name',
        ], [
            'name' => 'ILIKE',
        ]);
        $mapper->apply($query->where(), $qb->getQueryBuilder());

        return $qb->paginate($query->page(), $query->perPage());
    }
}
