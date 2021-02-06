<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Permissions\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Permissions\Forms\CreatePermissionRequest;
use App\Users\Delivery\Api\V1\Permissions\Transformers\PermissionViewTransformer;
use App\Users\Domain\Commands\CreatePermission;
use App\Users\Domain\Models\PermissionName;
use App\Users\Domain\Queries\FindPermissionByName;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;

/**
 * Class CreateController
 *
 * @package    App\Users\Delivery\Api\V1\Permissions\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Permissions\Controllers\CreateController
 */
class CreateController extends ApiController
{

    public function __invoke(CreatePermissionRequest $request)
    {
        $this->command()->dispatch(new CreatePermission($n = new PermissionName($request->get('name'))));

        return $this->created(new ObjectType($this->query()->execute(new FindPermissionByName($n)), PermissionViewTransformer::class));
    }
}
