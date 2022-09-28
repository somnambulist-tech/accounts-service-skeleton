<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Users\Forms\ChangeAuthCredentialsRequest;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use App\Users\Domain\Commands\ChangeUsersAuthCredentials;
use App\Users\Domain\Queries\GetUserById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Somnambulist\Components\ReadModels\Manager;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChangeAuthCredentialsController extends ApiController
{
    public function __invoke(ChangeAuthCredentialsRequest $request, Uuid $id): JsonResponse
    {
        $this->command()->dispatch(
            new ChangeUsersAuthCredentials(
                $id,
                $request->get('email'),
                $request->get('password')
            )
        );

        // command bus will cause the previous model instance to be cached, so flush here
        Manager::clear();

        return $this->updated(new ObjectType($this->query()->execute(new GetUserById($id)), UserViewTransformer::class));
    }
}
