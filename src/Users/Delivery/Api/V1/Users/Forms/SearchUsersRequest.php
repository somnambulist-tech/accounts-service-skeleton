<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use App\Resources\Delivery\Api\Forms\FormRequest;

class SearchUsersRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'account_id' => 'nullable|uuid',
            'name'       => 'nullable|string|between:1,100',
            'email'      => 'nullable|email|between:1,100',
            'active'     => 'nullable|numeric|between:0,1',
            'page'       => 'numeric|min:1',
            'per_page'   => 'numeric|min:1|max:100',
            'include'    => [
                'nullable',
                'regex:/(users(.roles)?(.permissions)?)|(roles(.permissions)?)/',
            ],
            'order'      => [
                'nullable',
                'regex:/-?(id|name|created_at|updated_at){1,},?/',
            ],
        ];
    }
}
