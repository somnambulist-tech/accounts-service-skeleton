<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

class UpdateEmailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }
}
