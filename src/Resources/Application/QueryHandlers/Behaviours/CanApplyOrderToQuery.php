<?php declare(strict_types=1);

namespace App\Resources\Application\QueryHandlers\Behaviours;

use Somnambulist\Components\Queries\AbstractPaginatableQuery;
use Somnambulist\Components\ReadModels\ModelBuilder;

/**
 * @property-read array $availableOrderFields
 */
trait CanApplyOrderToQuery
{
    private function applySortCriteria(ModelBuilder $qb, AbstractPaginatableQuery $query, string $field, string $dir = 'ASC'): void
    {
        if (!$query->getOrderBy()->count()) {
            $qb->orderBy($field, $dir);

            return;
        }

        foreach ($query->getOrderBy() as $field => $dir) {
            if (in_array($field, $this->availableOrderFields)) {
                $qb->orderBy($field, $dir);
            }
        }
    }
}
