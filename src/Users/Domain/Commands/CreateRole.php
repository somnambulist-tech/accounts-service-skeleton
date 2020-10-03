<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use App\Users\Domain\Models\Name;
use Somnambulist\Domain\Commands\AbstractCommand;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Class CreateRole
 *
 * @package    App\Users\Domain\Commands
 * @subpackage App\Users\Domain\Commands\CreateRole
 */
class CreateRole extends AbstractCommand
{

    private Uuid $id;
    private Name $name;
    private array $permissions;
    private array $roles;

    public function __construct(Uuid $id, Name $name, array $permissions = [], array $roles = [])
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

    public function getName(): Name
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
