<?php declare(strict_types=1);

namespace App\Accounts\Domain\Commands;

use Somnambulist\Components\Commands\AbstractCommand;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class DeactivateAccount extends AbstractCommand
{
    public function __construct(public readonly Uuid $id)
    {
    }
}
