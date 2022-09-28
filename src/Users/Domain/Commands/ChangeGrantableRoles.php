<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Components\Commands\AbstractCommand;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class ChangeGrantableRoles extends AbstractCommand
{

    private Uuid $id;
    private array $roles;

    public function __construct(Uuid $id, array $roles = [])
    {
        $this->id    = $id;
        $this->roles = $roles;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
