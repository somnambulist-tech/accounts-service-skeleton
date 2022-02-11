<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Delivery\Api\V1\Accounts\Forms\SearchAccountsRequest;
use App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer;
use App\Accounts\Domain\Queries\FindAccounts;
use App\Resources\Delivery\Api\ApiController;
use Pagerfanta\Pagerfanta;
use Somnambulist\Bundles\ApiBundle\Response\Types\PagerfantaType;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ListController
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Controllers
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Controllers\ListController
 */
class ListController extends ApiController
{

    public function __invoke(SearchAccountsRequest $request)
    {
        /** @var Pagerfanta $result */
        $query = new FindAccounts(
            [
                'id'   => $request->nullOrValue('query', ['id'], Uuid::class),
                'name' => $request->nullOrValue('query', ['name']),
            ],
            $request->orderBy(),
            $request->page(),
            $request->perPage(null, 100)
        );
        $query->with(...$request->includes());

        $result = $this->query()->execute($query);

        $binding = new PagerfantaType(
            $result,
            AccountViewTransformer::class,
            $this->generateUrl($request->attributes->get('_route'), $request->query->all(), UrlGeneratorInterface::ABSOLUTE_URL)
        );
        $binding->withIncludes(...$request->includes());

        return $this->paginate($binding);
    }
}
