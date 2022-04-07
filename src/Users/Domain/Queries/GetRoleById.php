<?php declare(strict_types=1);

namespace App\Users\Domain\Queries;

use Somnambulist\Components\Domain\Queries\AbstractFindByIdQuery;
use Somnambulist\Components\Domain\Queries\Behaviours\CanIncludeRelatedData;

/**
 * Class GetRoleById
 *
 * @package    App\Users\Domain\Queries
 * @subpackage App\Users\Domain\Queries\GetRoleById
 */
class GetRoleById extends AbstractFindByIdQuery
{
    use CanIncludeRelatedData;
}
