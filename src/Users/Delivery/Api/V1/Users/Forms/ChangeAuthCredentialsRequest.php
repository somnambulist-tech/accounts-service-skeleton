<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use Somnambulist\Bundles\FormRequestBundle\Http\FormRequest;

/**
 * Class ChangeAuthCredentialsRequest
 *
 * @package    App\Users\Delivery\Api\V1\Users\Forms
 * @subpackage App\Users\Delivery\Api\V1\Users\Forms\ChangeAuthCredentialsRequest
 */
class ChangeAuthCredentialsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'    => 'required|email|min:3|max:60',
            'password' => 'required|min:1|max:255',
        ];
    }
}
