<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Forms;

use Adamsafr\FormRequestBundle\Http\FormRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreateRoleRequest
 *
 * @package    App\Users\Delivery\Api\V1\Roles\Forms
 * @subpackage App\Users\Delivery\Api\V1\Roles\Forms\CreateRoleRequest
 */
class CreateRoleRequest extends FormRequest
{
    /**
     * @return Constraint|Constraint[]|Assert\Collection|null
     */
    public function rules()
    {
        return new Assert\Collection([
            'fields' => [
                'name' => new Assert\Required([
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
