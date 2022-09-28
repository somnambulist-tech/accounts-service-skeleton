<?php declare(strict_types=1);

namespace App\Accounts\Domain\Services\Repositories;

use App\Accounts\Domain\Models\Account;
use Somnambulist\Components\Models\Exceptions\EntityNotFoundException;
use Somnambulist\Components\Models\Types\Identity\Uuid;

interface AccountRepository
{

    /**
     * @param Uuid $id
     *
     * @return Account
     * @throws EntityNotFoundException
     */
    public function find(Uuid $id): Account;

    public function store(Account $account): bool;

    public function destroy(Account $account): bool;

}
