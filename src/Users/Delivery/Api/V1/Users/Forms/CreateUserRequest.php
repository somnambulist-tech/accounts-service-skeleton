<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use Adamsafr\FormRequestBundle\Http\FormRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreateUserRequest
 *
 * @package    App\Users\Delivery\Api\V1\Users\Forms
 * @subpackage App\Users\Delivery\Api\V1\Users\Forms\CreateUserRequest
 */
class CreateUserRequest extends FormRequest
{
    /**
     * @return Constraint|Constraint[]|Assert\Collection|null
     */
    public function rules()
    {
        return new Assert\Collection([
            'fields' => [
                'account_id' => new Assert\Required([
                    new Assert\Uuid(),
                ]),
                'email'     => new Assert\Required([
                    new Assert\Email(),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 60,
                    ]),
                ]),
                'password' => new Assert\Required([
                    new Assert\NotNull(),
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 1,
                        'max' => 255,
                    ]),
                ]),
                'name' => new Assert\Optional([
                    new Assert\NotNull(),
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 1,
                        'max' => 255,
                    ]),
                ]),
                'roles' => new Assert\Optional([
                    new Assert\Type('array'),
                    new Assert\All([
                        new Assert\NotNull(),
                        new Assert\NotBlank(),
                        new Assert\Length([
                            'min' => 1,
                            'max' => 255,
                        ]),
                    ]),
                ]),
                'permissions' => new Assert\Optional([
                    new Assert\Type('array'),
                    new Assert\All([
                        new Assert\NotNull(),
                        new Assert\NotBlank(),
                        new Assert\Length([
                            'min' => 1,
                            'max' => 255,
                        ]),
                    ]),
                ]),
            ],
        ]);
    }
}
