<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'account_id'    => 'required|uuid',
            'email'         => 'required|email|min:3|max:60',
            'password'      => 'required|min:1|max:255',
            'name'          => 'required|min:1|max:255',
            'roles'         => 'array',
            'roles.*'       => 'min:1|max:255',
            'permissions'   => 'array',
            'permissions.*' => 'min:1|max:255',
        ];
    }
}
