<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Roles\Forms\SearchRolesRequest;
use App\Users\Delivery\Api\V1\Roles\Transformers\RoleViewTransformer;
use App\Users\Domain\Queries\FindRoles;
use Pagerfanta\Pagerfanta;
use Somnambulist\Bundles\ApiBundle\Response\Types\PagerfantaType;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListController extends ApiController
{
    public function __invoke(SearchRolesRequest $request): JsonResponse
    {
        $query = new FindRoles([], [], $request->page(), $request->perPage());
        $query->with(...$request->includes());

        /** @var Pagerfanta $result */
        $result = $this->query()->execute($query);

        return $this->paginate(PagerfantaType::fromFormRequest($request, $result, RoleViewTransformer::class));
    }
}
