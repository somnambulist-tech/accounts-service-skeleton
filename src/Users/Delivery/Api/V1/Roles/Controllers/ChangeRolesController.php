<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Roles\Forms\ChangeGrantableRolesRequest;
use App\Users\Delivery\Api\V1\Roles\Transformers\RoleViewTransformer;
use App\Users\Domain\Commands\ChangeGrantableRoles;
use App\Users\Domain\Queries\GetRoleById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChangeRolesController extends ApiController
{
    public function __invoke(ChangeGrantableRolesRequest $request, Uuid $id): JsonResponse
    {
        $this->command()->dispatch(new ChangeGrantableRoles($id, $request->get('roles', [])));

        return $this->updated(
            (new ObjectType($this->query()->execute(new GetRoleById($id)), RoleViewTransformer::class))
                ->include('roles', 'permissions')
        );
    }
}
