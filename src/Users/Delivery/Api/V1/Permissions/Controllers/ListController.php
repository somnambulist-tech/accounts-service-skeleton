<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Permissions\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Permissions\Forms\SearchPermissionsRequest;
use App\Users\Delivery\Api\V1\Permissions\Transformers\PermissionViewTransformer;
use App\Users\Domain\Queries\FindPermissions;
use Pagerfanta\Pagerfanta;
use Somnambulist\Bundles\ApiBundle\Response\Types\PagerfantaType;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListController extends ApiController
{
    public function __invoke(SearchPermissionsRequest $request): JsonResponse
    {
        $query = new FindPermissions([], [], $request->page(), $request->perPage(50, 5000));

        /** @var Pagerfanta $result */
        $result = $this->query()->execute($query);

        return $this->paginate(PagerfantaType::fromFormRequest($request, $result, PermissionViewTransformer::class));
    }
}
