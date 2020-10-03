<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Roles\Forms\CreateRoleRequest;
use App\Users\Delivery\Api\V1\Roles\Transformers\RoleViewTransformer;
use App\Users\Domain\Commands\CreateRole;
use App\Users\Domain\Models\Name;
use App\Users\Domain\Queries\FindRoleById;
use Somnambulist\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Domain\Utils\IdentityGenerator;

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
            new Name($request->get('name')),
            $request->getRequest()->request->all('permissions'),
            $request->getRequest()->request->all('roles'),
        ));

        return $this->created(
            (new ObjectType($this->query()->execute(new FindRoleById($id)), RoleViewTransformer::class))
                ->withIncludes('roles', 'permissions')
        );
    }
}
