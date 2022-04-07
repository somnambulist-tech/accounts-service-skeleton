<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Roles\Forms\ViewRoleRequest;
use App\Users\Delivery\Api\V1\Roles\Transformers\RoleViewTransformer;
use App\Users\Domain\Queries\GetRoleById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ViewController
 *
 * @package    App\Users\Delivery\Api\V1\Roles\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Roles\Controllers\ViewController
 */
class ViewController extends ApiController
{
    public function __invoke(ViewRoleRequest $request, Uuid $id): JsonResponse
    {
        $query = new GetRoleById($id);
        $query->with(...$request->includes());

        return $this->item(
            (new ObjectType($this->query()->execute($query), RoleViewTransformer::class))->include(...$request->includes())
        );
    }
}
