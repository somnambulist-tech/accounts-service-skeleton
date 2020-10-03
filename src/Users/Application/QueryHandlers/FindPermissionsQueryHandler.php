<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\PermissionView;
use App\Users\Domain\Queries\FindPermissions;

/**
 * Class FindPermissionsQueryHandler
 *
 * @package    App\Users\Application\QueryHandlers
 * @subpackage App\Users\Application\QueryHandlers\FindPermissionsQueryHandler
 */
class FindPermissionsQueryHandler
{

    public function __invoke(FindPermissions $query)
    {
        return PermissionView::query()->orderBy('name', 'ASC')->paginate($query->getPage(), $query->getPerPage());
    }
}
