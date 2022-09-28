<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Users\Forms\ViewUserRequest;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use App\Users\Domain\Queries\GetUserById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class ViewController extends ApiController
{
    public function __invoke(ViewUserRequest $request, Uuid $id): JsonResponse
    {
        $query   = new GetUserById($id);
        $query->with(...$request->includes());

        $entity = $this->query()->execute($query);

        return $this->item(ObjectType::fromFormRequest($request, $entity, UserViewTransformer::class));
    }
}
