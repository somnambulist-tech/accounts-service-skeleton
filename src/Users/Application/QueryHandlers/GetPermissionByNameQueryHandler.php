<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\PermissionView;
use App\Users\Domain\Models\Permission;
use App\Users\Domain\Queries\GetPermissionByName;
use Somnambulist\Components\Models\Exceptions\EntityNotFoundException;
use Somnambulist\Components\ReadModels\Exceptions\NoResultsException;

class GetPermissionByNameQueryHandler
{
    public function __invoke(GetPermissionByName $query): PermissionView
    {
        try {
            return PermissionView::query()->whereColumn('name', '=', $query->getName())->fetchFirstOrFail();
        } catch (NoResultsException) {
            throw EntityNotFoundException::entityNotFound(Permission::class, (string)$query->getName());
        }
    }
}
