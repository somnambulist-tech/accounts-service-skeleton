<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use App\Users\Domain\Models\RoleName;
use Somnambulist\Components\Commands\AbstractCommand;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class CreateRole extends AbstractCommand
{
    public function __construct(
        public readonly Uuid $id,
        public readonly RoleName $name,
        public readonly array $permissions = [],
        public readonly array $roles = []
    ) {
    }
}
