<?php declare(strict_types=1);

namespace App\Accounts\Domain\Services\Repositories;

use App\Accounts\Domain\Models\Account;
use Somnambulist\Domain\Entities\Exceptions\EntityNotFoundException;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Interface AccountRepository
 *
 * @package    App\Accounts\Domain\Services\Repositories
 * @subpackage App\Accounts\Domain\Services\Repositories\AccountRepository
 */
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
