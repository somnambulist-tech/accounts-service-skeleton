<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use App\Users\Domain\Queries\FindUsers;
use Pagerfanta\Pagerfanta;
use Somnambulist\ApiBundle\Response\Types\PagerfantaType;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ListController
 *
 * @package    App\Users\Delivery\Api\V1\Users\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Users\Controllers\ListController
 */
class ListController extends ApiController
{

    public function __invoke(Request $request)
    {
        $query = new FindUsers([
            'account_id' => $this->nullOrValue($request->query, ['account_id'], Uuid::class),
            'name'       => $this->nullOrValue($request->query, ['name']),
            'email'      => $this->nullOrValue($request->query, ['email']),
            'active'     => $this->nullOrValue($request->query, ['active']),
        ], [], $this->page($request), $this->perPage($request));
        $query->with($inc = $this->includes($request));

        /** @var Pagerfanta $result */
        $result  = $this->query()->execute($query);
        $binding = new PagerfantaType(
            $result,
            UserViewTransformer::class,
            $this->generateUrl($request->attributes->get('_route'), $request->query->all(), UrlGeneratorInterface::ABSOLUTE_URL)
        );
        $binding->withIncludes($inc);

        return $this->paginate($binding);
    }
}
