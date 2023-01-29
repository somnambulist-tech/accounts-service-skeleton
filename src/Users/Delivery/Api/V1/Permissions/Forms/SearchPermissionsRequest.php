<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Permissions\Forms;

use App\Users\Domain\Queries\FindPermissions;
use Somnambulist\Bundles\ApiBundle\Request\Filters\Decoders\SimpleApiFilterDecoder;
use Somnambulist\Bundles\ApiBundle\Request\SearchFormRequest;

class SearchPermissionsRequest extends SearchFormRequest
{
    public function rules(): array
    {
        return [
            'filters'  => 'sometimes|array',
            'page'     => 'numeric|min:1',
            'per_page' => 'numeric|min:1|max:100',
        ];
    }

    public function asQueryObject(): FindPermissions
    {
        $query = new FindPermissions(
            (new SimpleApiFilterDecoder())->useFiltersQueryName('filters')->decode($this),
            $this->orderBy('name'),
            $this->page(),
            $this->perPage(max: 100),
        );
        $query->include(...$this->includes());

        return $query;
    }
}
