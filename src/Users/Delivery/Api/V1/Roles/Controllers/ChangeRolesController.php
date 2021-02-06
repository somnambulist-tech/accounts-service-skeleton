<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Roles\Forms\ChangeGrantableRolesRequest;
use App\Users\Delivery\Api\V1\Roles\Transformers\RoleViewTransformer;
use App\Users\Domain\Commands\ChangeGrantableRoles;
use App\Users\Domain\Queries\FindRoleById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Class ChangeRolesController
 *
 * @package    App\Users\Delivery\Api\V1\Roles\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Roles\Controllers\ChangeRolesController
 */
class ChangeRolesController extends ApiController
{

    public function __invoke(ChangeGrantableRolesRequest $request, Uuid $id)
    {
        $this->command()->dispatch(new ChangeGrantableRoles($id, $request->get('roles', [])));

        return $this->updated(
            (new ObjectType($this->query()->execute(new FindRoleById($id)), RoleViewTransformer::class))
                ->withIncludes('roles', 'permissions')
        );
    }
}
