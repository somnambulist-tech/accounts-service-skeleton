<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use App\Users\Domain\Models\PermissionName;
use Somnambulist\Components\Commands\AbstractCommand;

class CreatePermission extends AbstractCommand
{
    public function __construct(public readonly PermissionName $name)
    {
    }
}
