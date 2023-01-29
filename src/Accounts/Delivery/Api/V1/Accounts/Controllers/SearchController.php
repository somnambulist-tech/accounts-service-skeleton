<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Delivery\Api\V1\Accounts\Forms\SearchAccountsRequest;
use App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer;
use App\Resources\Delivery\Api\ApiController;
use Pagerfanta\Pagerfanta;
use Somnambulist\Bundles\ApiBundle\Response\Types\PagerfantaType;
use Symfony\Component\HttpFoundation\JsonResponse;

class SearchController extends ApiController
{
    public function __invoke(SearchAccountsRequest $request): JsonResponse
    {
        /** @var Pagerfanta $result */
        $result = $this->query()->execute($request->asQueryObject());

        return $this->paginate(PagerfantaType::fromFormRequest($request, $result, AccountViewTransformer::class));
    }
}
