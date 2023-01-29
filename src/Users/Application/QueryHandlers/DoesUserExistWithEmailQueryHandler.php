<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\UserView;
use App\Users\Domain\Queries\DoesUserExistWithEmail;
use Somnambulist\Components\ReadModels\Exceptions\EntityNotFoundException;

class DoesUserExistWithEmailQueryHandler
{
    public function __invoke(DoesUserExistWithEmail $query): bool
    {
        $qb = UserView::query();
        $qb->whereColumn('email', '=', $query->email)->limit(1);

        if ($query->ignoreUser) {
            $qb->whereColumn('id', '!=', $query->ignoreUser);
        }

        try {
            return $qb->fetch()->count() > 0;
        } catch (EntityNotFoundException) {
            return false;
        }
    }
}
