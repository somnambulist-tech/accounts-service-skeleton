<?php declare(strict_types=1);

namespace App\Accounts\Domain\Queries;

use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Somnambulist\Components\Domain\Queries\AbstractQuery;

/**
 * Class CountUsersOnAccount
 *
 * @package    App\Accounts\Domain\Queries
 * @subpackage App\Accounts\Domain\Queries\CountUsersOnAccount
 */
class CountUsersOnAccount extends AbstractQuery
{
    public function __construct(private Uuid $id)
    {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }
}
