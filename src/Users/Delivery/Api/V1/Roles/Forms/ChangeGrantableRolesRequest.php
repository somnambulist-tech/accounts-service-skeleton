<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

/**
 * Class ChangeGrantableRolesRequest
 *
 * @package    App\Users\Delivery\Api\V1\Roles\Forms
 * @subpackage App\Users\Delivery\Api\V1\Roles\Forms\ChangeGrantableRolesRequest
 */
class ChangeGrantableRolesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'roles' => 'required|array',
            'roles.*' => 'min:1|max:255',
        ];
    }
}
