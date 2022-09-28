<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\UserView;
use App\Users\Domain\Models\User;
use App\Users\Domain\Queries\GetUserById;
use Somnambulist\Components\Models\Exceptions\EntityNotFoundException;
use Somnambulist\Components\ReadModels\Exceptions\EntityNotFoundException as ReadModelNotFound;

class GetUserByIdQueryHandler
{
    public function __invoke(GetUserById $query): UserView
    {
        $qb = UserView::query();
        $qb->with(...$query->getIncludes())->orderBy('name');

        try {
            return $qb->findOrFail($query->getId());
        } catch (ReadModelNotFound) {
            throw EntityNotFoundException::entityNotFound(User::class, (string)$query->getId());
        }
    }
}
