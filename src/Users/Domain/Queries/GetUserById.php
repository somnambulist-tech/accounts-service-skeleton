<?php declare(strict_types=1);

namespace App\Users\Domain\Queries;

use Somnambulist\Components\Queries\AbstractFindByIdQuery;
use Somnambulist\Components\Queries\Behaviours\CanIncludeRelatedData;

class GetUserById extends AbstractFindByIdQuery
{
    use CanIncludeRelatedData;
}
