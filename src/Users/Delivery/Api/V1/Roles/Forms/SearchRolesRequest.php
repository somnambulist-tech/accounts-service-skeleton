<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Forms;

use App\Resources\Delivery\Api\Forms\FormRequest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SearchUsersRequest
 *
 * @package    App\Users\Delivery\Api\V1\Permissions\Forms
 * @subpackage App\Users\Delivery\Api\V1\Permissions\Forms\SearchUsersRequest
 */
class SearchRolesRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'page'     => 'numeric|min:1',
            'per_page' => 'numeric|min:1|max:100',
            'include'  => [
                'nullable',
                'regex:/(users(.roles)?(.permissions)?)|(roles(.permissions)?)/',
            ],
        ];
    }
}
