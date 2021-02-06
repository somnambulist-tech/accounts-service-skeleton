<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Components\Domain\Commands\AbstractCommand;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Class ChangeUsersName
 *
 * @package    App\Users\Domain\Commands
 * @subpackage App\Users\Domain\Commands\ChangeUsersName
 */
class ChangeUsersName extends AbstractCommand
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
