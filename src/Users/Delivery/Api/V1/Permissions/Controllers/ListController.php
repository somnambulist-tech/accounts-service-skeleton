<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Permissions\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Permissions\Forms\SearchPermissionsRequest;
use App\Users\Delivery\Api\V1\Permissions\Transformers\PermissionViewTransformer;
use App\Users\Domain\Queries\FindPermissions;
use Pagerfanta\Pagerfanta;
use Somnambulist\Bundles\ApiBundle\Response\Types\PagerfantaType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ListController
 *
 * @package    App\Users\Delivery\Api\V1\Permissions\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Permissions\Controllers\ListController
 */
class ListController extends ApiController
{
    public function __invoke(SearchPermissionsRequest $request): JsonResponse
    {
        $query = new FindPermissions([], [], $request->page(), $request->perPage(50, 5000));

        /** @var Pagerfanta $result */
        $result  = $this->query()->execute($query);
        $binding = new PagerfantaType(
            $result,
            PermissionViewTransformer::class,
            $this->generateUrl($request->attributes->get('_route'), $request->query->all(), UrlGeneratorInterface::ABSOLUTE_URL)
        );

        return $this->paginate($binding);
    }
}
