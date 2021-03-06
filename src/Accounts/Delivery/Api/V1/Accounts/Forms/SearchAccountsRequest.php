<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Forms;

use App\Resources\Delivery\Api\Forms\FormRequest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SearchAccountsRequest
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Forms
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Forms\SearchAccountsRequest
 */
class SearchAccountsRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'id'       => 'nullable|uuid',
            'name'     => 'nullable|string|between:1,100',
            'page'     => 'numeric|min:1',
            'per_page' => 'numeric|min:1|max:100',
            'include'  => [
                'nullable',
                'regex:/(users(.roles)?(.permissions)?)|(roles(.permissions)?)/',
            ],
            'order'    => [
                'nullable',
                'regex:/-?(id|name|created_at|updated_at){1,},?/'
            ],
        ];
    }
}
