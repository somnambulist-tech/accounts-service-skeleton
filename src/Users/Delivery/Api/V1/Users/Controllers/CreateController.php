<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Users\Forms\CreateUserRequest;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use App\Users\Domain\Commands\CreateUser;
use App\Users\Domain\Models\AccountId;
use App\Users\Domain\Queries\GetUserById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Utils\IdentityGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateController extends ApiController
{
    public function __invoke(CreateUserRequest $request): JsonResponse
    {
        $this->command()->dispatch(
            new CreateUser(
                $id = IdentityGenerator::random(),
                new AccountId($request->data()->get('account_id')),
                $request->data()->get('email'),
                $request->data()->get('password'),
                $request->data()->get('name'),
                $request->data()->get('roles', []),
                $request->data()->get('permissions', []),
            )
        );

        return $this->created(
            new ObjectType($this->query()->execute(new GetUserById($id)), UserViewTransformer::class)
        );
    }
}
