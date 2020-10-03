<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Domain\Commands\AbstractCommand;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Class DestroyRole
 *
 * @package    App\Users\Domain\Commands
 * @subpackage App\Users\Domain\Commands\DestroyRole
 */
class DestroyRole extends AbstractCommand
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
