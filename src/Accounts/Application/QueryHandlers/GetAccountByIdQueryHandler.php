<?php declare(strict_types=1);

namespace App\Accounts\Application\QueryHandlers;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Accounts\Domain\Models\Account;
use App\Accounts\Domain\Queries\GetAccountById;
use Somnambulist\Components\Domain\Entities\Exceptions\EntityNotFoundException;
use Somnambulist\Components\ReadModels\Exceptions\EntityNotFoundException as ReadModelNotFound;

/**
 * Class GetAccountByIdQueryHandler
 *
 * @package    App\Accounts\Application\QueryHandlers
 * @subpackage App\Accounts\Application\QueryHandlers\GetAccountByIdQueryHandler
 */
class GetAccountByIdQueryHandler
{
    public function __invoke(GetAccountById $query): AccountView
    {
        try {
            return AccountView::findOrFail($query->getId());
        } catch (ReadModelNotFound) {
            throw EntityNotFoundException::entityNotFound(Account::class, (string)$query->getId());
        }
    }
}
