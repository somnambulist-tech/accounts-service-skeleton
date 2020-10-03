<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Forms;

use Adamsafr\FormRequestBundle\Http\FormRequest;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UpdateEmailRequest
 *
 * @package    App\Users\Delivery\Api\V1\Users\Forms
 * @subpackage App\Users\Delivery\Api\V1\Users\Forms\UpdateEmailRequest
 */
class UpdateEmailRequest extends FormRequest
{

    /**
     * @return Constraint|Constraint[]|Assert\Collection|null
     */
    public function rules()
    {
        return new Assert\Collection([
            'fields' => [
                'email' => new Assert\Required([
                    new Assert\Email(),
                ]),
            ],
        ]);
    }
}
