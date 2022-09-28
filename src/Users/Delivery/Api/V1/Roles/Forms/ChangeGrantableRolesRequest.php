<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

class ChangeGrantableRolesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'roles' => 'required|array',
            'roles.*' => 'min:1|max:255',
        ];
    }
}
