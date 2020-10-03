<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Users\Forms\UpdateAccountRequest;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use App\Users\Domain\Commands\ChangeUsersAccount;
use App\Users\Domain\Queries\FindUserById;
use Somnambulist\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ChangeAccountController
 *
 * @package    App\Users\Delivery\Api\V1\Users\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Users\Controllers\ChangeAccountController
 */
class ChangeAccountController extends ApiController
{

    public function __invoke(UpdateAccountRequest $request, Uuid $id): JsonResponse
    {
        $this->command()->dispatch(new ChangeUsersAccount($id, new Uuid($request->get('account_id'))));

        return $this->updated(new ObjectType($this->query()->execute(new FindUserById($id)), UserViewTransformer::class));
    }
}
