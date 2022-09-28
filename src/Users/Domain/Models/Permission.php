<?php declare(strict_types=1);

namespace App\Users\Domain\Models;

use Somnambulist\Components\Models\Types\DateTime\DateTime;

class Permission
{
    private ?int $id = null;
    private PermissionName $name;
    private DateTime $createdAt;

    public function __construct(PermissionName $name)
    {
        $this->name = $name;
        $this->createdAt = DateTime::now();
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): PermissionName
    {
        return $this->name;
    }
}
