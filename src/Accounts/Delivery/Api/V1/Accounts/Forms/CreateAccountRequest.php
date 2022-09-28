<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Forms;

use App\Resources\Delivery\Api\Forms\FormRequest;

class CreateAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id'   => 'required|uuid',
            'name' => 'required|max:255',
        ];
    }
}
