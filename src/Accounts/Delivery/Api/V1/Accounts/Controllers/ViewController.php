<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Delivery\Api\V1\Accounts\Forms\ViewAccountRequest;
use App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer;
use App\Accounts\Domain\Queries\GetAccountById;
use App\Resources\Delivery\Api\ApiController;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class ViewController extends ApiController
{
    public function __invoke(ViewAccountRequest $request, Uuid $id): JsonResponse
    {
        $account = $this->query()->execute((new GetAccountById($id))->with(...$request->includes()));

        return $this->item((ObjectType::fromFormRequest($request, $account, AccountViewTransformer::class)));
    }
}
