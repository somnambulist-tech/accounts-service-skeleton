<?php declare(strict_types=1);

namespace App\Users\Domain\Services\Repositories;

use App\Users\Domain\Models\Permission;
use Somnambulist\Domain\Entities\Exceptions\EntityNotFoundException;

/**
 * Interface PermissionRepository
 *
 * @package    App\Users\Domain\Services\Repositories
 * @subpackage App\Users\Domain\Services\Repositories\PermissionRepository
 */
interface PermissionRepository
{

    /**
     * @param int $id
     *
     * @return Permission
     * @throws EntityNotFoundException
     */
    public function find(int $id): Permission;

    /**
     * @param string $name
     *
     * @return Permission
     * @throws EntityNotFoundException
     */
    public function findByName(string $name): Permission;

    public function store(Permission $permission): bool;

    public function destroy(Permission $permission): bool;

}
