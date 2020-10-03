<?php declare(strict_types=1);

namespace App\Users\Domain\Queries;

use App\Users\Domain\Models\Name;
use Somnambulist\Domain\Queries\AbstractQuery;

/**
 * Class FindPermissionByName
 *
 * @package    App\Users\Domain\Queries
 * @subpackage App\Users\Domain\Queries\FindPermissionByName
 */
class FindPermissionByName extends AbstractQuery
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
