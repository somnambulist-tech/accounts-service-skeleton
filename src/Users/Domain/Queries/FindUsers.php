<?php declare(strict_types=1);

namespace App\Users\Domain\Queries;

use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Somnambulist\Components\Domain\Queries\AbstractPaginatableQuery;

/**
 * Class FindUsers
 *
 * @package    App\Users\Domain\Queries
 * @subpackage App\Users\Domain\Queries\FindUsers
 */
class FindUsers extends AbstractPaginatableQuery
{
    public function getAccountId(): ?Uuid
    {
        return $this->getCriteria()->get('account_id');
    }

    public function getEmailAddress(): ?string
    {
        return $this->getCriteria()->get('email');
    }

    public function getActive(): ?bool
    {
        return $this->getCriteria()->get('active');
    }

    public function getName(): ?string
    {
        return $this->getCriteria()->get('string');
    }
}
