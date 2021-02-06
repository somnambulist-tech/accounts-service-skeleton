<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

/**
 * Class CreateAccountRequest
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Forms
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Forms\CreateAccountRequest
 */
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
