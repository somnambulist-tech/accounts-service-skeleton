<?php declare(strict_types=1);

namespace App\Users\Domain\Queries;

use Somnambulist\Components\Queries\AbstractFindByIdQuery;
use Somnambulist\Components\Queries\Behaviours\CanIncludeRelatedData;

class GetRoleById extends AbstractFindByIdQuery
{
    use CanIncludeRelatedData;
}
