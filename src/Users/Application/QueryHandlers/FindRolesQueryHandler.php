<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\RoleView;
use App\Users\Domain\Queries\FindRoles;
use Pagerfanta\Pagerfanta;

class FindRolesQueryHandler
{
    public function __invoke(FindRoles $query): Pagerfanta
    {
        $qb = RoleView::with(...$query->getIncludes());
        $qb->orderBy('name');

        if ($query->getName()) {
            $qb->whereColumn('name', 'ILIKE', sprintf('%%%s%%', $query->getName()));
        }

        return $qb->paginate($query->getPage(), $query->getPerPage());
    }
}
