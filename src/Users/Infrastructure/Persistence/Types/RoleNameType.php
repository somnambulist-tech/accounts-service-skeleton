<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Types;

use App\Users\Domain\Models\RoleName;

class RoleNameType extends AbstractNameType
{
    protected string $name = 'role_name';
    protected string $class = RoleName::class;
}
