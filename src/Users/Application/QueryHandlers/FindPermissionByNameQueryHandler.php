<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\PermissionView;
use App\Users\Domain\Models\Permission;
use App\Users\Domain\Queries\FindPermissionByName;
use Somnambulist\Components\Domain\Entities\Exceptions\EntityNotFoundException;
use Somnambulist\Components\ReadModels\Exceptions\NoResultsException;

/**
 * Class FindPermissionByNameQueryHandler
 *
 * @package    App\Users\Application\QueryHandlers
 * @subpackage App\Users\Application\QueryHandlers\FindPermissionByNameQueryHandler
 */
class FindPermissionByNameQueryHandler
{

    public function __invoke(FindPermissionByName $query)
    {
        try {
            return PermissionView::query()->whereColumn('name', '=', $query->getName())->fetchFirstOrFail();
        } catch (NoResultsException $e) {
            throw EntityNotFoundException::entityNotFound(Permission::class, $query->getName());
        }
    }
}
