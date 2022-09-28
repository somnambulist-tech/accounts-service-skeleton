<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use App\Users\Domain\Models\RoleName;
use Somnambulist\Components\Commands\AbstractCommand;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class CreateRole extends AbstractCommand
{

    private Uuid     $id;
    private RoleName $name;
    private array    $permissions;
    private array $roles;

    public function __construct(Uuid $id, RoleName $name, array $permissions = [], array $roles = [])
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->permissions = $permissions;
        $this->roles       = $roles;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): RoleName
    {
        return $this->name;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
