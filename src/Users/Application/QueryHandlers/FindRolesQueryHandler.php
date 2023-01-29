<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\RoleView;
use App\Users\Domain\Queries\FindRoles;
use Pagerfanta\Pagerfanta;
use Somnambulist\Bundles\ApiBundle\Request\Filters\ApplyApiExpressionsToDBALQueryBuilder;

class FindRolesQueryHandler
{
    public function __invoke(FindRoles $query): Pagerfanta
    {
        $qb = RoleView::include(...$query->includes());
        $qb->orderBy('name');

        (new ApplyApiExpressionsToDBALQueryBuilder([
            'name' => 'r.name',
        ], [
            'name' => 'ILIKE',
        ]))->apply($query->where(), $qb->getQueryBuilder());

        return $qb->paginate($query->page(), $query->perPage());
    }
}
