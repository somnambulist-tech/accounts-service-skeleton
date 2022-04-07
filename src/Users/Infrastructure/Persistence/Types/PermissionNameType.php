<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Types;

use App\Users\Domain\Models\PermissionName;

/**
 * Class PermissionNameType
 *
 * @package    App\Users\Infrastructure\Persistence\Types
 * @subpackage App\Users\Infrastructure\Persistence\Types\PermissionNameType
 */
class PermissionNameType extends AbstractNameType
{
    protected string $name = 'permission_name';
    protected string $class = PermissionName::class;
}
