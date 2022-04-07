<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Users\Forms\ViewUserRequest;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use App\Users\Domain\Queries\GetUserById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ViewController
 *
 * @package    App\Users\Delivery\Api\V1\Users\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Users\Controllers\ViewController
 */
class ViewController extends ApiController
{
    public function __invoke(ViewUserRequest $request, Uuid $id): JsonResponse
    {
        $query   = new GetUserById($id);
        $query->with(...$request->includes());

        $entity = $this->query()->execute($query);

        return $this->item(
            (new ObjectType($entity, UserViewTransformer::class))->include(...$request->includes())
        );
    }
}
