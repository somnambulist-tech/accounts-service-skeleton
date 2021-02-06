<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Roles\Forms\ChangePermissionsRequest;
use App\Users\Delivery\Api\V1\Roles\Transformers\RoleViewTransformer;
use App\Users\Domain\Commands\ChangeRolePermissions;
use App\Users\Domain\Queries\FindRoleById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Class ChangePermissionsController
 *
 * @package    App\Users\Delivery\Api\V1\Roles\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Roles\Controllers\ChangePermissionsController
 */
class ChangePermissionsController extends ApiController
{

    public function __invoke(ChangePermissionsRequest $request, Uuid $id)
    {
        $this->command()->dispatch(new ChangeRolePermissions($id, $request->get('permissions', [])));

        return $this->updated(
            (new ObjectType($this->query()->execute(new FindRoleById($id)), RoleViewTransformer::class))
                ->withIncludes('roles', 'permissions')
        );
    }
}
