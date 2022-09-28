<?php declare(strict_types=1);

namespace App\Accounts\Domain\Queries;

use Somnambulist\Components\Models\Types\Identity\Uuid;
use Somnambulist\Components\Queries\AbstractPaginatableQuery;

class FindAccounts extends AbstractPaginatableQuery
{

    public function getId(): ?Uuid
    {
        return $this->getCriteria()->get('id');
    }

    public function getName(): ?string
    {
        return $this->getCriteria()->get('name');
    }
}
