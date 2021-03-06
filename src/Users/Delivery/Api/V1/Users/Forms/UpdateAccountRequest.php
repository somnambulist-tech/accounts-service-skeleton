<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

/**
 * Class UpdateAccountRequest
 *
 * @package    App\Users\Delivery\Api\V1\Users\Forms
 * @subpackage App\Users\Delivery\Api\V1\Users\Forms\UpdateAccountRequest
 */
class UpdateAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'account_id' => 'required|uuid',
        ];
    }
}
