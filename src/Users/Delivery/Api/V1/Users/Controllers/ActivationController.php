<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use App\Users\Domain\Commands\ActivateUser;
use App\Users\Domain\Commands\DeactivateUser;
use App\Users\Domain\Queries\GetUserById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class ActivationController extends ApiController
{
    public function activateAction(Uuid $id): JsonResponse
    {
        $this->command()->dispatch(new ActivateUser($id));

        return $this->updated(new ObjectType($this->query()->execute(new GetUserById($id)), UserViewTransformer::class));
    }

    public function deactivateAction(Uuid $id): JsonResponse
    {
        $this->command()->dispatch(new DeactivateUser($id));

        return $this->updated(new ObjectType($this->query()->execute(new GetUserById($id)), UserViewTransformer::class));
    }
}
