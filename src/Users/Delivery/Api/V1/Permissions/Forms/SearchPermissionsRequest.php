<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Permissions\Forms;

use App\Resources\Delivery\Api\Forms\FormRequest;

class SearchPermissionsRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'page'     => 'numeric|min:1',
            'per_page' => 'numeric|min:1|max:100',
        ];
    }
}
