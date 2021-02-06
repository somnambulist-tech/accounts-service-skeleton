<?php declare(strict_types=1);

namespace App\Accounts\Application\QueryHandlers;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Accounts\Domain\Models\Account;
use App\Accounts\Domain\Queries\FindAccountById;
use Somnambulist\Components\ReadModels\Exceptions\EntityNotFoundException as ReadModelNotFound;
use Somnambulist\Components\Domain\Entities\Exceptions\EntityNotFoundException;

/**
 * Class FindAccountByIdQueryHandler
 *
 * @package    App\Accounts\Application\QueryHandlers
 * @subpackage App\Accounts\Application\QueryHandlers\FindAccountByIdQueryHandler
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
