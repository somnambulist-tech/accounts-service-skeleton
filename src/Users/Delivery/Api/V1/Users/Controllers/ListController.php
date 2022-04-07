<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Users\Forms\SearchUsersRequest;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use App\Users\Domain\Queries\FindUsers;
use Pagerfanta\Pagerfanta;
use Somnambulist\Bundles\ApiBundle\Response\Types\PagerfantaType;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ListController
 *
 * @package    App\Users\Delivery\Api\V1\Users\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Users\Controllers\ListController
 */
class ListController extends ApiController
{
    public function __invoke(SearchUsersRequest $request): JsonResponse
    {
        $query = new FindUsers([
            'account_id' => $request->nullOrValue('query', ['account_id'], Uuid::class),
            'name'       => $request->nullOrValue('query', ['name']),
            'email'      => $request->nullOrValue('query', ['email']),
            'active'     => $request->nullOrValue('query', ['active']),
        ], [], $request->page(), $request->perPage());
        $query->with(...$request->includes());

        /** @var Pagerfanta $result */
        $result  = $this->query()->execute($query);
        $binding = new PagerfantaType(
            $result,
            UserViewTransformer::class,
            $this->generateUrl($request->attributes->get('_route'), $request->query->all(), UrlGeneratorInterface::ABSOLUTE_URL)
        );
        $binding->include(...$request->includes());

        return $this->paginate($binding);
    }
}
