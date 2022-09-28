<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\UserView;
use App\Users\Domain\Queries\FindUsers;
use Pagerfanta\Pagerfanta;

class FindUsersQueryHandler
{
    public function __invoke(FindUsers $query): Pagerfanta
    {
        $qb = UserView::query();
        $qb->with(...$query->getIncludes())->orderBy('name');

        if ($query->getAccountId()) {
            $qb->whereColumn('account_id', '=', (string)$query->getAccountId());
        }

        if ($query->getName()) {
            $qb->whereColumn('name', 'ILIKE', sprintf('%%%s%%', $query->getName()));
        }

        if ($query->getEmailAddress()) {
            $qb->whereColumn('email', '=', $query->getEmailAddress());
        }

        if ($query->getActive()) {
            $qb->whereColumn('active', '=', $query->getActive());
        }

        return $qb->paginate($query->getPage(), $query->getPerPage());
    }
}
