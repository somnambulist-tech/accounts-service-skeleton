<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Forms;

use App\Accounts\Domain\Commands\CreateAccount;
use App\Resources\Delivery\Api\Forms\FormRequest;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class CreateAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id'   => 'required|uuid',
            'name' => 'required|max:255',
        ];
    }

    public function command(): CreateAccount
    {
        return new CreateAccount(
            new Uuid($this->data()->get('id')),
            $this->data()->get('name'),
        );
    }
}
