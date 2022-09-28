<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Types;

use App\Users\Domain\Models\PermissionName;

class PermissionNameType extends AbstractNameType
{
    protected string $name = 'permission_name';
    protected string $class = PermissionName::class;
}
