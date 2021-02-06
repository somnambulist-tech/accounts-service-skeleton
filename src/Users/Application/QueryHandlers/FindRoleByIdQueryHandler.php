<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\RoleView;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Queries\FindRoleById;
use Somnambulist\Components\Domain\Entities\Exceptions\EntityNotFoundException;
use Somnambulist\Components\ReadModels\Exceptions\EntityNotFoundException as ReadModelNotFound;

/**
 * Class FindRoleByIdentityQueryHandler
 *
 * @package    App\Users\Application\QueryHandlers
 * @subpackage App\Users\Application\QueryHandlers\FindRoleByIdentityQueryHandler
 */
class FindRoleByIdQueryHandler
{

    public function __invoke(FindRoleById $query)
    {
        $qb = RoleView::query();
        $qb->with($query->getIncludes());

        try {
            return $qb->findOrFail((string)$query->getId());
        } catch (ReadModelNotFound $e) {
            throw EntityNotFoundException::entityNotFound(Role::class, $query->getId());
        }
    }
}
