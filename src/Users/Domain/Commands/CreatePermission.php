<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use App\Users\Domain\Models\PermissionName;
use Somnambulist\Components\Commands\AbstractCommand;

class CreatePermission extends AbstractCommand
{

    private PermissionName $name;

    public function __construct(PermissionName $name)
    {
        $this->name = $name;
    }

    public function getName(): PermissionName
    {
        return $this->name;
    }
}
