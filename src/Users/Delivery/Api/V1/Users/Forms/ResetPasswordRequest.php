<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required|min:1|max:255',
        ];
    }
}
