<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Permissions\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:1|max:255',
        ];
    }
}
