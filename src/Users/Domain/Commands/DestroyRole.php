<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Components\Commands\AbstractCommand;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class DestroyRole extends AbstractCommand
{
    public function __construct(public readonly Uuid $id)
    {
    }
}
