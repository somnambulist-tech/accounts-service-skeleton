<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Components\Commands\AbstractCommand;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class ChangeUsersAccount extends AbstractCommand
{

    protected Uuid $id;
    protected Uuid $accountId;

    public function __construct(Uuid $id, Uuid $accountId)
    {
        $this->id        = $id;
        $this->accountId = $accountId;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getAccountId(): Uuid
    {
        return $this->accountId;
    }
}
