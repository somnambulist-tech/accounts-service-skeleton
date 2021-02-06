<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

/**
 * Class ChangeNameRequest
 *
 * @package    App\Users\Delivery\Api\V1\Users\Forms
 * @subpackage App\Users\Delivery\Api\V1\Users\Forms\ChangeNameRequest
 */
class ChangeNameRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:1|max:255',
        ];
    }
}
