<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use App\Users\Domain\Models\Name;
use Somnambulist\Domain\Commands\AbstractCommand;

/**
 * Class CreatePermission
 *
 * @package    App\Users\Domain\Commands
 * @subpackage App\Users\Domain\Commands\CreatePermission
 */
class CreatePermission extends AbstractCommand
{

    private Name $name;

    public function __construct(Name $name)
    {
        $this->name = $name;
    }

    public function getName(): Name
    {
        return $this->name;
    }
}
