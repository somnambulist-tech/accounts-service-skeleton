<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Forms;

use App\Resources\Delivery\Api\Forms\FormRequest;
use App\Users\Domain\Queries\FindRoles;
use Somnambulist\Bundles\ApiBundle\Request\Filters\Decoders\SimpleApiFilterDecoder;

class SearchRolesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'filters'  => 'sometimes|array',
            'page'     => 'numeric|min:1',
            'per_page' => 'numeric|min:1|max:100',
            'include'  => [
                'nullable',
                'regex:/(users(.roles)?(.permissions)?)|(roles(.permissions)?)/',
            ],
        ];
    }

    public function asQueryObject(): FindRoles
    {
        $query = new FindRoles(
            (new SimpleApiFilterDecoder())->useFiltersQueryName('filters')->decode($this),
            $this->orderBy('name'),
            $this->page(),
            $this->perPage(max: 100),
        );
        $query->include(...$this->includes());

        return $query;
    }
}
