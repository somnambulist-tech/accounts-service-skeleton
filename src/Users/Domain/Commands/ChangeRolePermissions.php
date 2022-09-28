<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Components\Commands\AbstractCommand;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class ChangeRolePermissions extends AbstractCommand
{

    private Uuid $id;
    private array $permissions;

    public function __construct(Uuid $id, array $permissions = [])
    {
        $this->id          = $id;
        $this->permissions = $permissions;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }
}
