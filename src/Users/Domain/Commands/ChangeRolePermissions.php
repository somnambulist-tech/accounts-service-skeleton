<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Components\Commands\AbstractCommand;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class ChangeRolePermissions extends AbstractCommand
{
    public function __construct(public readonly Uuid $id, public readonly array $permissions = [])
    {
    }
}
