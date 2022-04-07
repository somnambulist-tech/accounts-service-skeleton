<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Forms;

use App\Resources\Delivery\Api\Forms\FormRequest;

/**
 * Class ViewAccountRequest
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Forms
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Forms\ViewAccountRequest
 */
class ViewAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'include'  => [
                'nullable',
                'regex:/(users(.roles)?(.permissions)?)|(roles(.permissions)?)/',
            ],
        ];
    }
}
