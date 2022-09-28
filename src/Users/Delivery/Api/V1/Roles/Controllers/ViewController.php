<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Roles\Forms\ViewRoleRequest;
use App\Users\Delivery\Api\V1\Roles\Transformers\RoleViewTransformer;
use App\Users\Domain\Queries\GetRoleById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class ViewController extends ApiController
{
    public function __invoke(ViewRoleRequest $request, Uuid $id): JsonResponse
    {
        $query = new GetRoleById($id);
        $query->with(...$request->includes());

        return $this->item(ObjectType::fromFormRequest($request, $this->query()->execute($query), RoleViewTransformer::class));
    }
}
