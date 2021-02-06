<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer;
use App\Accounts\Domain\Queries\FindAccounts;
use App\Resources\Delivery\Api\ApiController;
use Pagerfanta\Pagerfanta;
use Somnambulist\Bundles\ApiBundle\Response\Types\PagerfantaType;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ListController
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Controllers
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Controllers\ListController
 */
class ListController extends ApiController
{

    public function __invoke(Request $request)
    {
        /** @var Pagerfanta $result */
        $query = new FindAccounts(
            [
                'id'   => $this->nullOrValue($request->query, ['id'], Uuid::class),
                'name' => $this->nullOrValue($request->query, ['name']),
            ],
            $this->orderBy($request),
            $this->page($request),
            $this->perPage($request, null, 100)
        );
        $query->with($inc = $this->includes($request));

        $result = $this->query()->execute($query);

        $binding = new PagerfantaType(
            $result,
            AccountViewTransformer::class,
            $this->generateUrl($request->attributes->get('_route'), $request->query->all(), UrlGeneratorInterface::ABSOLUTE_URL)
        );
        $binding->withIncludes($inc);

        return $this->paginate($binding);
    }
}
