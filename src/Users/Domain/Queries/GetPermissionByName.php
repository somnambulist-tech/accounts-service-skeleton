<?php declare(strict_types=1);

namespace App\Users\Domain\Queries;

use App\Users\Domain\Models\PermissionName;
use Somnambulist\Components\Queries\AbstractQuery;

class GetPermissionByName extends AbstractQuery
{
    public function __construct(private PermissionName $name)
    {
    }

    public function getName(): PermissionName
    {
        return $this->name;
    }
}
