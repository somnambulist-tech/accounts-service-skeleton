<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\RoleView;
use App\Users\Domain\Queries\FindRoles;

/**
 * Class FindRolesQueryHandler
 *
 * @package    App\Users\Application\QueryHandlers
 * @subpackage App\Users\Application\QueryHandlers\FindRolesQueryHandler
 */
class FindRolesQueryHandler
{

    public function __invoke(FindRoles $query)
    {
        $qb = RoleView::with(...$query->getIncludes());
        $qb->orderBy('name', 'ASC');

        if ($query->getName()) {
            $qb->whereColumn('name', 'ILIKE', sprintf('%%%s%%', $query->getName()));
        }

        return $qb->paginate($query->getPage(), $query->getPerPage());
    }
}
