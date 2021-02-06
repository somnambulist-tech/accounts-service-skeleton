<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Components\Domain\Commands\AbstractCommand;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Class DeactivateUser
 *
 * @package    App\Users\Domain\Commands
 * @subpackage App\Users\Domain\Commands\DeactivateUser
 */
class DeactivateUser extends AbstractCommand
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
