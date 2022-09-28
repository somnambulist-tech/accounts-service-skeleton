<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\PermissionView;
use App\Users\Domain\Queries\FindPermissions;
use Pagerfanta\Pagerfanta;

class FindPermissionsQueryHandler
{
    public function __invoke(FindPermissions $query): Pagerfanta
    {
        return PermissionView::query()->orderBy('name')->paginate($query->getPage(), $query->getPerPage());
    }
}
