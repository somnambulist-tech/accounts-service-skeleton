<?php declare(strict_types=1);

namespace App\Accounts\Domain\Commands;

use Somnambulist\Components\Commands\AbstractCommand;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class CreateAccount extends AbstractCommand
{

    private Uuid   $id;
    private string $name;

    public function __construct(Uuid $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

}
