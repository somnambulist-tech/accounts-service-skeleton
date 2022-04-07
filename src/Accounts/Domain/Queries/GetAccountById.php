<?php declare(strict_types=1);

namespace App\Accounts\Domain\Queries;

use Somnambulist\Components\Domain\Queries\AbstractFindByIdQuery;
use Somnambulist\Components\Domain\Queries\Behaviours\CanIncludeRelatedData;

/**
 * Class GetAccountById
 *
 * @package    App\Accounts\Domain\Queries
 * @subpackage App\Accounts\Domain\Queries\GetAccountById
 */
class GetAccountById extends AbstractFindByIdQuery
{

    use CanIncludeRelatedData;
}
