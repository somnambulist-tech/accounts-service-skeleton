<?php declare(strict_types=1);

namespace App\Accounts\Domain\Queries;

use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Somnambulist\Components\Domain\Queries\AbstractPaginatableQuery;

/**
 * Class FindAccounts
 *
 * @package    App\Accounts\Domain\Queries
 * @subpackage App\Accounts\Domain\Queries\FindAccounts
 */
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
