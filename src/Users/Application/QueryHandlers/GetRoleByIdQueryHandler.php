<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\RoleView;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Queries\GetRoleById;
use Somnambulist\Components\Models\Exceptions\EntityNotFoundException;
use Somnambulist\Components\ReadModels\Exceptions\EntityNotFoundException as ReadModelNotFound;

class GetRoleByIdQueryHandler
{
    public function __invoke(GetRoleById $query): RoleView
    {
        $qb = RoleView::query();
        $qb->include(...$query->includes());

        try {
            return $qb->findOrFail((string)$query->id());
        } catch (ReadModelNotFound) {
            throw EntityNotFoundException::entityNotFound(Role::class, (string)$query->id());
        }
    }
}
