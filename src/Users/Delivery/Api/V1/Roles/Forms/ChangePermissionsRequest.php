<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

/**
 * Class ChangePermissionsRequest
 *
 * @package    App\Users\Delivery\Api\V1\Roles\Forms
 * @subpackage App\Users\Delivery\Api\V1\Roles\Forms\ChangePermissionsRequest
 */
class ChangePermissionsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'permissions' => 'required|array',
            'permissions.*' => 'min:1|max:255',
        ];
    }
}
