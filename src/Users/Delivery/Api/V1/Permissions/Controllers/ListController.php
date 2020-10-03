<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Permissions\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Permissions\Transformers\PermissionViewTransformer;
use App\Users\Domain\Queries\FindPermissions;
use Pagerfanta\Pagerfanta;
use Somnambulist\ApiBundle\Response\Types\PagerfantaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ListController
 *
 * @package    App\Users\Delivery\Api\V1\Permissions\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Permissions\Controllers\ListController
 */
class ListController extends ApiController
{

    public function __invoke(Request $request)
    {
        $query = new FindPermissions([], [], $this->page($request), $this->perPage($request, 50, 5000));

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
