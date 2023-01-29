<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Delivery\Api\V1\Accounts\Forms\CreateAccountRequest;
use App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer;
use App\Accounts\Domain\Queries\GetAccountById;
use App\Resources\Delivery\Api\ApiController;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateController extends ApiController
{
    public function __invoke(CreateAccountRequest $request): JsonResponse
    {
        $this->command()->dispatch($request->command());

        return $this->created(
            ObjectType::fromFormRequest(
                $request,
                $this->query()->execute(new GetAccountById($request->command()->id)),
                AccountViewTransformer::class,
                'data'
            )
        );
    }
}
