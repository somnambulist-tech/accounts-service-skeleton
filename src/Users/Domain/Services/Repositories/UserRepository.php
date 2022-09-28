<?php declare(strict_types=1);

namespace App\Users\Domain\Services\Repositories;

use App\Users\Domain\Models\User;
use Somnambulist\Components\Models\Exceptions\EntityNotFoundException;
use Somnambulist\Components\Models\Types\Identity\Uuid;

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
