<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Forms;

use App\Resources\Delivery\Api\Forms\FormRequest;

class SearchRolesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page'     => 'numeric|min:1',
            'per_page' => 'numeric|min:1|max:100',
            'include'  => [
                'nullable',
                'regex:/(users(.roles)?(.permissions)?)|(roles(.permissions)?)/',
            ],
        ];
    }
}
