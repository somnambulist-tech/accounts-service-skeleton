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

    private Uuid $id;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }
}
