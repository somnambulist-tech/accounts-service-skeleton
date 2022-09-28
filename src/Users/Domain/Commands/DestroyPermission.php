<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Components\Commands\AbstractCommand;

class DestroyPermission extends AbstractCommand
{

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
