<?php declare(strict_types=1);

namespace App\Accounts\Domain\Queries;

use Somnambulist\Components\Models\Types\Identity\Uuid;
use Somnambulist\Components\Queries\AbstractQuery;

class CountUsersOnAccount extends AbstractQuery
{
    public function __construct(public readonly Uuid $id)
    {
    }
}
