<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use App\Resources\Delivery\Api\Forms\FormRequest;
use App\Users\Domain\Queries\FindUsers;
use Somnambulist\Bundles\ApiBundle\Request\Filters\Decoders\SimpleApiFilterDecoder;

class SearchUsersRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'filters'            => 'sometimes|array|array_can_only_have_keys:account_id,name,email,active',
            'filters.account_id' => 'sometimes|uuid',
            'filters.name'       => 'sometimes|string|between:1,100',
            'filters.email'      => 'sometimes|email|between:1,100',
            'filters.active'     => 'sometimes|numeric|between:0,1',
            'page'               => 'numeric|min:1',
            'per_page'           => 'numeric|min:1|max:100',
            'include'            => [
                'sometimes',
                'regex:/(users(.roles)?(.permissions)?)|(roles(.permissions)?)/',
            ],
            'order'              => [
                'sometimes',
                'regex:/-?(id|name|created_at|updated_at){1,},?/',
            ],
        ];
    }

    public function asQueryObject(): FindUsers
    {
        $query = new FindUsers(
            (new SimpleApiFilterDecoder())->useFiltersQueryName('filters')->decode($this),
            $this->orderBy('name'),
            $this->page(),
            $this->perPage(max: 100),
        );
        $query->include(...$this->includes());

        return $query;
    }
}
