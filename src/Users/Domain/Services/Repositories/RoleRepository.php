<?php declare(strict_types=1);

namespace App\Users\Domain\Services\Repositories;

use App\Users\Domain\Models\Role;
use Somnambulist\Components\Domain\Entities\Exceptions\EntityNotFoundException;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Interface RoleRepository
 *
 * @package    App\Users\Domain\Services\Repositories
 * @subpackage App\Users\Domain\Services\Repositories\RoleRepository
 */
interface RoleRepository
{
    /**
     * @param Uuid $id
     *
     * @return Role
     * @throws EntityNotFoundException
     */
    public function find(Uuid $id): Role;

    /**
     * @param string $name
     *
     * @return Role
     * @throws EntityNotFoundException
     */
    public function findByName(string $name): Role;

    public function store(Role $role): bool;

    public function destroy(Role $role): bool;
}
