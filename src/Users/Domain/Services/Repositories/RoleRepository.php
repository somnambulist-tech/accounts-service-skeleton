<?php declare(strict_types=1);

namespace App\Users\Domain\Services\Repositories;

use App\Users\Domain\Models\Role;
use Somnambulist\Components\Models\Exceptions\EntityNotFoundException;
use Somnambulist\Components\Models\Types\Identity\Uuid;

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
