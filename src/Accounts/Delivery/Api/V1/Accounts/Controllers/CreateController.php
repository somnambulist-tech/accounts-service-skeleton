<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Delivery\Api\V1\Accounts\Forms\CreateAccountRequest;
use App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer;
use App\Accounts\Domain\Commands\CreateAccount;
use App\Accounts\Domain\Queries\GetAccountById;
use App\Resources\Delivery\Api\ApiController;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateController extends ApiController
{
    public function __invoke(CreateAccountRequest $request): JsonResponse
    {
        $this->command()->dispatch(new CreateAccount($id = new Uuid($request->get('id')), $request->get('name')));

        return $this->created(ObjectType::fromFormRequest($request, $this->query()->execute(new GetAccountById($id)), AccountViewTransformer::class));
    }
}
