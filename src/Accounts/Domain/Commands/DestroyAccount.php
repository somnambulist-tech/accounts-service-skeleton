<?php declare(strict_types=1);

namespace App\Accounts\Domain\Commands;

use Somnambulist\Domain\Commands\AbstractCommand;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Class DestroyAccount
 *
 * @package    App\Accounts\Domain\Commands
 * @subpackage App\Accounts\Domain\Commands\DestroyAccount
 */
class DestroyAccount extends AbstractCommand
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
