<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Components\Domain\Commands\AbstractCommand;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Class ChangeUsersAccount
 *
 * @package    App\Users\Domain\Commands
 * @subpackage App\Users\Domain\Commands\ChangeUsersAccount
 */
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
