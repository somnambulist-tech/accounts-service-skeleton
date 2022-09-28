<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Users\Forms\ChangeNameRequest;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use App\Users\Domain\Commands\ChangeUsersName;
use App\Users\Domain\Queries\GetUserById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChangeNameController extends ApiController
{
    public function __invoke(ChangeNameRequest $request, Uuid $id): JsonResponse
    {
        $this->command()->dispatch(new ChangeUsersName($id, $request->get('name')));

        return $this->updated(new ObjectType($this->query()->execute(new GetUserById($id)), UserViewTransformer::class));
    }
}
