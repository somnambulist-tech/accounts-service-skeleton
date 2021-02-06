<?php declare(strict_types=1);

namespace App\Users\Domain\Queries;

use App\Users\Domain\Models\PermissionName;
use Somnambulist\Components\Domain\Queries\AbstractQuery;

/**
 * Class FindPermissionByName
 *
 * @package    App\Users\Domain\Queries
 * @subpackage App\Users\Domain\Queries\FindPermissionByName
 */
class FindPermissionByName extends AbstractQuery
{

    private PermissionName $name;

    public function __construct(PermissionName $name)
    {
        $this->name = $name;
    }

    public function getName(): PermissionName
    {
        return $this->name;
    }
}
