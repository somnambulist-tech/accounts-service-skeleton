<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Users\Delivery\ViewModels\UserView;
use App\Users\Domain\Models\User;
use App\Users\Domain\Queries\FindUserById;
use Somnambulist\Components\Domain\Entities\Exceptions\EntityNotFoundException;
use Somnambulist\Components\ReadModels\Exceptions\EntityNotFoundException as ReadModelNotFound;

/**
 * Class FindUserByIdQueryHandler
 *
 * @package    App\Users\Application\QueryHandlers
 * @subpackage App\Users\Application\QueryHandlers\FindUserByIdQueryHandler
 */
class FindUserByIdQueryHandler
{
    public function __invoke(FindUserById $query)
    {
        $qb = UserView::query();
        $qb->with($query->getIncludes())->orderBy('name', 'ASC');

        try {
            return $qb->findOrFail($query->getId());
        } catch (ReadModelNotFound $e) {
            throw EntityNotFoundException::entityNotFound(User::class, $query->getId());
        }
    }
}
