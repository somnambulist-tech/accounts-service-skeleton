<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Domain\Commands\AbstractCommand;

/**
 * Class DestroyPermission
 *
 * @package    App\Users\Domain\Commands
 * @subpackage App\Users\Domain\Commands\DestroyPermission
 */
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
