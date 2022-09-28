<?php declare(strict_types=1);

namespace App\Users\Domain\Queries;

use Somnambulist\Components\Queries\AbstractPaginatableQuery;

class FindRoles extends AbstractPaginatableQuery
{
    public function getName(): ?string
    {
        return $this->getCriteria()->get('name');
    }
}
