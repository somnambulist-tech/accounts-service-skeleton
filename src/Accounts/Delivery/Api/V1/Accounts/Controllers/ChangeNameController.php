<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Delivery\Api\V1\Accounts\Forms\ChangeAccountNameRequest;
use App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer;
use App\Accounts\Domain\Commands\ChangeAccountName;
use App\Accounts\Domain\Queries\GetAccountById;
use App\Resources\Delivery\Api\ApiController;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChangeNameController extends ApiController
{
    public function __invoke(ChangeAccountNameRequest $request, Uuid $id): JsonResponse
    {
        $this->command()->dispatch(new ChangeAccountName($id, $request->get('name')));

        return $this->updated(ObjectType::fromFormRequest($request, $this->query()->execute(new GetAccountById($id)), AccountViewTransformer::class));
    }
}
