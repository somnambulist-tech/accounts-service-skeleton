<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Components\Commands\AbstractCommand;

class DestroyPermission extends AbstractCommand
{
    public function __construct(public readonly string $name)
    {
    }
}
