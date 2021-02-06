<?php declare(strict_types=1);

namespace App\Users\Application\QueryHandlers;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Accounts\Domain\Models\Account;
use App\Users\Domain\Queries\FindAccountById;
use Somnambulist\Components\Domain\Entities\Exceptions\EntityNotFoundException;
use Somnambulist\Components\ReadModels\Exceptions\EntityNotFoundException as ReadModelNotFound;

/**
 * Class FindAccountByIdQueryHandler
 *
 * @package    App\Users\Application\QueryHandlers
 * @subpackage App\Users\Application\QueryHandlers\FindAccountByIdQueryHandler
 */
class FindAccountByIdQueryHandler
{

    public function __invoke(FindAccountById $query)
    {
        try {
            return AccountView::findOrFail($query->getId());
        } catch (ReadModelNotFound $e) {
            throw EntityNotFoundException::entityNotFound(Account::class, $query->getId());
        }
    }
}
