<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use Adamsafr\FormRequestBundle\Http\FormRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ChangeAuthCredentialsRequest
 *
 * @package    App\Users\Delivery\Api\V1\Users\Forms
 * @subpackage App\Users\Delivery\Api\V1\Users\Forms\ChangeAuthCredentialsRequest
 */
class ChangeAuthCredentialsRequest extends FormRequest
{

    /**
     * @return Constraint|Constraint[]|Assert\Collection|null
     */
    public function rules()
    {
        return new Assert\Collection([
            'fields' => [
                'email' => new Assert\Required([
                    new Assert\NotBlank(),
                    new Assert\NotNull(),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 60,
                    ]),
                    new Assert\Email(),
                ]),
                'password' => new Assert\Required([
                    new Assert\NotNull(),
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'max' => 255,
                    ]),
                ]),
            ],
        ]);
    }
}
