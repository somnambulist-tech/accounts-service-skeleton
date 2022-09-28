<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Delivery\Api\V1\Accounts\Forms\SearchAccountsRequest;
use App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer;
use App\Accounts\Domain\Queries\FindAccounts;
use App\Resources\Delivery\Api\ApiController;
use Pagerfanta\Pagerfanta;
use Somnambulist\Bundles\ApiBundle\Response\Types\PagerfantaType;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListController extends ApiController
{
    public function __invoke(SearchAccountsRequest $request): JsonResponse
    {
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

        /** @var Pagerfanta $result */
        $result = $this->query()->execute($query);

        return $this->paginate(PagerfantaType::fromFormRequest($request, $result, AccountViewTransformer::class));
    }
}
