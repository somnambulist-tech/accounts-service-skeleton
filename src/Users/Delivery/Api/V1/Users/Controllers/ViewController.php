<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use App\Users\Domain\Queries\FindUserById;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ViewController
 *
 * @package    App\Users\Delivery\Api\V1\Users\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Users\Controllers\ViewController
 */
class ViewController extends ApiController
{

    public function __invoke(Request $request, Uuid $id)
    {
        $query   = new FindUserById($id);
        $query->with($inc = $this->includes($request));

        $entity = $this->query()->execute($query);

        return $this->item(
            (new ObjectType($entity, UserViewTransformer::class))->withIncludes($inc)
        );
    }
}
