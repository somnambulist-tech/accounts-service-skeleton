<?php declare(strict_types=1);

namespace App\Accounts\Domain\Queries;

use Somnambulist\Components\Domain\Queries\AbstractFindByIdQuery;
use Somnambulist\Components\Domain\Queries\Behaviours\CanIncludeRelatedData;

/**
 * Class FindAccountById
 *
 * @package    App\Accounts\Domain\Queries
 * @subpackage App\Accounts\Domain\Queries\FindAccountById
 */
class FindAccountById extends AbstractFindByIdQuery
{

    use CanIncludeRelatedData;
}
