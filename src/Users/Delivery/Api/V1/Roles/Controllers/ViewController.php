<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Roles\Transformers\RoleViewTransformer;
use App\Users\Domain\Queries\FindRoleById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ViewController
 *
 * @package    App\Users\Delivery\Api\V1\Roles\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Roles\Controllers\ViewController
 */
class ViewController extends ApiController
{

    public function __invoke(Request $request, Uuid $id)
    {
        $query = new FindRoleById($id);
        $query->with(...$this->includes($request));

        return $this->item((new ObjectType($this->query()->execute($query), RoleViewTransformer::class))->withIncludes(...$this->includes($request)));
    }
}
