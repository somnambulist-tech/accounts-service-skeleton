<?php declare(strict_types=1);

namespace App\Users\Domain\Queries;

use Somnambulist\Components\Models\Types\Identity\Uuid;
use Somnambulist\Components\Queries\AbstractQuery;

class DoesUserExistWithEmail extends AbstractQuery
{
    public function __construct(
        public readonly string $email,
        public readonly ?Uuid $ignoreUser = null
    ) {
    }
}
