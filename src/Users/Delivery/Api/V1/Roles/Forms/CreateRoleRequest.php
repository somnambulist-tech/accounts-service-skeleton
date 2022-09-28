<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'          => 'required|min:1|max:255',
            'roles'         => 'array',
            'roles.*'       => 'min:1|max:255',
            'permissions'   => 'array',
            'permissions.*' => 'min:1|max:255',
        ];
    }
}
