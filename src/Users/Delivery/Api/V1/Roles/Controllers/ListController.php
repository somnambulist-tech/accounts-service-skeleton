<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Roles\Transformers\RoleViewTransformer;
use App\Users\Domain\Queries\FindRoles;
use Pagerfanta\Pagerfanta;
use Somnambulist\ApiBundle\Response\Types\PagerfantaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ListController
 *
 * @package    App\Users\Delivery\Api\V1\Roles\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Roles\Controllers\ListController
 */
class ListController extends ApiController
{

    public function __invoke(Request $request)
    {
        $query = new FindRoles([], [], $this->page($request), $this->perPage($request));
        $query->with($inc = $this->includes($request));

        /** @var Pagerfanta $result */
        $result  = $this->query()->execute($query);
        $binding = new PagerfantaType(
            $result,
            RoleViewTransformer::class,
            $this->generateUrl($request->attributes->get('_route'), $request->query->all(), UrlGeneratorInterface::ABSOLUTE_URL)
        );
        $binding->withIncludes($inc);

        return $this->paginate($binding);
    }
}
