<?php declare(strict_types=1);

namespace App\Accounts\Domain\Queries;

use Somnambulist\Components\Queries\AbstractFindByIdQuery;
use Somnambulist\Components\Queries\Behaviours\CanIncludeRelatedData;

class GetAccountById extends AbstractFindByIdQuery
{

    use CanIncludeRelatedData;
}
