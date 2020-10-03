<?php declare(strict_types=1);

namespace App\Users\Domain\Queries;

use Somnambulist\Domain\Queries\AbstractPaginatableQuery;

/**
 * Class FindRoles
 *
 * @package    App\Users\Domain\Queries
 * @subpackage App\Users\Domain\Queries\FindRoles
 */
class FindRoles extends AbstractPaginatableQuery
{

    public function getName(): ?string
    {
        return $this->getCriteria()->get('name');
    }
}
