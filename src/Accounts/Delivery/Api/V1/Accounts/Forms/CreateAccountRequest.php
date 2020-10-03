<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Forms;

use Adamsafr\FormRequestBundle\Http\FormRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreateAccountRequest
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Forms
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Forms\CreateAccountRequest
 */
class CreateAccountRequest extends FormRequest
{
    /**
     * @return Constraint|Constraint[]|Assert\Collection|null
     */
    public function rules()
    {
        return new Assert\Collection([
            'fields' => [
                'id'     => new Assert\Required([
                    new Assert\Uuid(),
                ]),
                'name'     => new Assert\Required([
                    new Assert\NotBlank(),
                    new Assert\NotNull(),
                    new Assert\Length(['max' => 255]),
                ]),
            ],
        ]);
    }
}
