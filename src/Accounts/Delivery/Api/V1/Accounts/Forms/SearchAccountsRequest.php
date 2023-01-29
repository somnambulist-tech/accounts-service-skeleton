<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Forms;

use App\Accounts\Domain\Queries\FindAccounts;
use Somnambulist\Bundles\ApiBundle\Request\Filters\Decoders\SimpleApiFilterDecoder;
use Somnambulist\Bundles\ApiBundle\Request\SearchFormRequest;

class SearchAccountsRequest extends SearchFormRequest
{
    public function rules(): array
    {
        return [
            'filters'      => 'sometimes|array|array_only_has_keys:id,name',
            'filters.id'   => 'sometimes|uuid',
            'filters.name' => 'sometimes|string|between:1,100',
            'page'         => 'numeric|min:1',
            'per_page'     => 'numeric|min:1|max:100',
            'include'      => [
                'sometimes',
                'regex:/(users(.roles)?(.permissions)?)|(roles(.permissions)?)/',
            ],
            'order'        => [
                'sometimes',
                'regex:/-?(id|name|created_at|updated_at){1,},?/',
            ],
        ];
    }

    public function asQueryObject(): FindAccounts
    {
        $query = new FindAccounts(
            (new SimpleApiFilterDecoder())->useFiltersQueryName('filters')->decode($this),
            $this->orderBy('-created_at'),
            $this->page(),
            $this->perPage(max: 100),
        );
        $query->include(...$this->includes());

        return $query;
    }
}
