<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Roles\Forms\CreateRoleRequest;
use App\Users\Delivery\Api\V1\Roles\Transformers\RoleViewTransformer;
use App\Users\Domain\Commands\CreateRole;
use App\Users\Domain\Models\RoleName;
use App\Users\Domain\Queries\FindRoleById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Domain\Utils\IdentityGenerator;

/**
 * Class CreateController
 *
 * @package    App\Users\Delivery\Api\V1\Roles\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Roles\Controllers\CreateController
 */
class CreateController extends ApiController
{

    public function __invoke(CreateRoleRequest $request)
    {
        $this->command()->dispatch(new CreateRole(
            $id = IdentityGenerator::random(),
            new RoleName($request->get('name')),
            $request->request->all('permissions'),
            $request->request->all('roles'),
        ));

        return $this->created(
            (new ObjectType($this->query()->execute(new FindRoleById($id)), RoleViewTransformer::class))
                ->withIncludes('roles', 'permissions')
        );
    }
}
