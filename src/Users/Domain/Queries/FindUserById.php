<?php declare(strict_types=1);

namespace App\Users\Domain\Queries;

use Somnambulist\Domain\Queries\AbstractFindByIdQuery;
use Somnambulist\Domain\Queries\Behaviours\CanIncludeRelatedData;

/**
 * Class FindUserById
 *
 * @package    App\Users\Domain\Queries
 * @subpackage App\Users\Domain\Queries\FindUserById
 */
class FindUserById extends AbstractFindByIdQuery
{

    use CanIncludeRelatedData;
}
