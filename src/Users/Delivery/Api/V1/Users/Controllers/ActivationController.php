<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use App\Users\Domain\Commands\ActivateUser;
use App\Users\Domain\Commands\DeactivateUser;
use App\Users\Domain\Queries\FindUserById;
use Somnambulist\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Class ActivationController
 *
 * @package    App\Users\Delivery\Api\V1\Users\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Users\Controllers\ActivationController
 */
class ActivationController extends ApiController
{

    public function activateAction(Uuid $id)
    {
        $this->command()->dispatch(new ActivateUser($id));

        return $this->updated(new ObjectType($this->query()->execute(new FindUserById($id)), UserViewTransformer::class));
    }

    public function deactivateAction(Uuid $id)
    {
        $this->command()->dispatch(new DeactivateUser($id));

        return $this->updated(new ObjectType($this->query()->execute(new FindUserById($id)), UserViewTransformer::class));
    }
}
