<?php declare(strict_types=1);

namespace App\Resources\Delivery\Api\Forms;

use Somnambulist\Bundles\ApiBundle\Request\Behaviours\GetFieldsFromParameterBag;
use Somnambulist\Bundles\ApiBundle\Request\Behaviours\GetFiltersFromParameterBag;
use Somnambulist\Bundles\ApiBundle\Request\Behaviours\GetIncludesFromParameterBag;
use Somnambulist\Bundles\ApiBundle\Request\Behaviours\GetOrderByFromParameterBag;
use Somnambulist\Bundles\ApiBundle\Request\Behaviours\GetPaginationFromParameterBag;
use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest as BaseFormRequest;

abstract class FormRequest extends BaseFormRequest
{
    use GetFieldsFromParameterBag;
    use GetFiltersFromParameterBag;
    use GetIncludesFromParameterBag;
    use GetPaginationFromParameterBag;
    use GetOrderByFromParameterBag;

    public function includes(): array
    {
        return $this->doGetIncludes($this->query);
    }

    public function fields(): array
    {
        return $this->doGetFields($this->query);
    }

    public function filters(): array
    {
        return $this->doGetFilters($this->query);
    }

    public function orderBy(string $default = null): array
    {
        return $this->doGetOrderBy($this->query, $default);
    }

    public function page(): int
    {
        return $this->doGetPage($this->query);
    }

    public function perPage(int $default = null, int $max = null): int
    {
        if (null !== $default = $this->data()->get('per_page', $default)) {
            $default = (int)$default;
        }

        return $this->doGetPerPage($this->query, $default, $max);
    }

    public function offset(int $limit = null): int
    {
        return $this->doGetOffset($this->query, $limit);
    }

    public function marker(): ?string
    {
        return $this->doGetOffsetMarker($this->query);
    }

    public function limit(int $default = null, int $max = null): int
    {
        if (null !== $default = $this->data()->get('limit', $default)) {
            $default = (int)$default;
        }

        return $this->doGetLimit($this->query, $default, $max);
    }
}
