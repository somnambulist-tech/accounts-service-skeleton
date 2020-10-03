<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Forms;

use Adamsafr\FormRequestBundle\Http\FormRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ChangeAccountNameRequest
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Forms
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Forms\ChangeAccountNameRequest
 */
class ChangeAccountNameRequest extends FormRequest
{

    /**
     * @return Constraint|Constraint[]|Assert\Collection|null
     */
    public function rules()
    {
        return new Assert\Collection([
            'fields' => [
                'name'  => new Assert\Required([
                    new Assert\NotBlank(),
                    new Assert\NotNull(),
                    new Assert\Length(['max' => 255]),
                ]),
            ],
        ]);
    }
}
