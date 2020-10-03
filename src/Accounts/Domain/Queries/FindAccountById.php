<?php declare(strict_types=1);

namespace App\Accounts\Domain\Queries;

use Somnambulist\Domain\Queries\AbstractFindByIdQuery;
use Somnambulist\Domain\Queries\Behaviours\CanIncludeRelatedData;

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
