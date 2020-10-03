<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use Adamsafr\FormRequestBundle\Http\FormRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ChangeNameRequest
 *
 * @package    App\Users\Delivery\Api\V1\Users\Forms
 * @subpackage App\Users\Delivery\Api\V1\Users\Forms\ChangeNameRequest
 */
class ChangeNameRequest extends FormRequest
{

    /**
     * @return Constraint|Constraint[]|Assert\Collection|null
     */
    public function rules()
    {
        return new Assert\Collection([
            'fields' => [
                'name' => new Assert\Required([
                    new Assert\NotBlank(),
                    new Assert\NotNull(),
                    new Assert\Length([
                        'min' => 1,
                        'max' => 255,
                    ]),
                ]),
            ],
        ]);
    }
}
