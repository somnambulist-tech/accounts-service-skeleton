<?php declare(strict_types=1);

namespace App\Accounts\Domain\Commands;

use Somnambulist\Domain\Commands\AbstractCommand;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Class ChangeAccountName
 *
 * @package    App\Accounts\Domain\Commands
 * @subpackage App\Accounts\Domain\Commands\ChangeAccountName
 */
class ChangeAccountName extends AbstractCommand
{

    private Uuid $id;
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
