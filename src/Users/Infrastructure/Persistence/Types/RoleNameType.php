<?php declare(strict_types=1);

namespace App\Users\Infrastructure\Persistence\Types;

use App\Users\Domain\Models\RoleName;

/**
 * Class RoleNameType
 *
 * @package    App\Users\Infrastructure\Persistence\Types
 * @subpackage App\Users\Infrastructure\Persistence\Types\RoleNameType
 */
class RoleNameType extends AbstractNameType
{

    protected string $name = 'role_name';
    protected string $class = RoleName::class;
}
