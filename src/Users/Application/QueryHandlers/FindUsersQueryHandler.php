<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\UserView;
use App\Users\Domain\Queries\FindUsers;
use Pagerfanta\Pagerfanta;
use Somnambulist\Bundles\ApiBundle\Request\Filters\ApplyApiExpressionsToDBALQueryBuilder;

class FindUsersQueryHandler
{
    public function __invoke(FindUsers $query): Pagerfanta
    {
        $qb = UserView::query();
        $qb->include(...$query->includes())->orderBy('name');

        (new ApplyApiExpressionsToDBALQueryBuilder([
            'account_id' => 'u.account_id',
            'name'       => 'u.name',
            'email'      => 'u.email',
            'active'     => 'u.active',
        ], [
            'name' => 'ILIKE',
        ]))->apply($query->where(), $qb->getQueryBuilder());

        return $qb->paginate($query->page(), $query->perPage());
    }
}
