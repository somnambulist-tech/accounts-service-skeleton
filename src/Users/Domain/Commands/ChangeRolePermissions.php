<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Domain\Commands\AbstractCommand;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Class ChangeRolePermissions
 *
 * @package    App\Users\Domain\Commands
 * @subpackage App\Users\Domain\Commands\ChangeRolePermissions
 */
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
