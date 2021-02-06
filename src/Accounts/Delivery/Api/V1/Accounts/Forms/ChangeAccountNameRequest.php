<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

/**
 * Class ChangeAccountNameRequest
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Forms
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Forms\ChangeAccountNameRequest
 */
class ChangeAccountNameRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|max:255'
        ];
    }
}
