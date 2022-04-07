<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use App\Resources\Delivery\Api\Forms\FormRequest;

/**
 * Class ViewUserRequest
 *
 * @package    App\Users\Delivery\Api\V1\Users\Forms
 * @subpackage App\Users\Delivery\Api\V1\Users\Forms\ViewUserRequest
 */
class ViewUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'include'    => [
                'nullable',
                'regex:/(users(.roles)?(.permissions)?)|(roles(.permissions)?)/',
            ],
        ];
    }
}
