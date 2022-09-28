<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Forms;

use App\Resources\Delivery\Api\Forms\FormRequest;

class ChangeAccountNameRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|max:255'
        ];
    }
}
