<?php declare(strict_types=1);

namespace App\Users\Domain\Services\Repositories;

use App\Users\Domain\Models\User;
use Somnambulist\Components\Domain\Entities\Exceptions\EntityNotFoundException;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Interface UserRepository
 *
 * @package    App\Users\Domain\Services\Repositories
 * @subpackage App\Users\Domain\Services\Repositories\UserRepository
 */
interface UserRepository
{

    /**
     * @param Uuid $id
     *
     * @return User
     * @throws EntityNotFoundException
     */
    public function find(Uuid $id): User;

    public function store(User $user): bool;

    public function destroy(User $user): bool;
}
