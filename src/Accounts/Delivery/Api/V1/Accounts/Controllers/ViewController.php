<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer;
use App\Accounts\Domain\Queries\FindAccountById;
use App\Resources\Delivery\Api\ApiController;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ViewController
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Controllers
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Controllers\ViewController
 */
class ViewController extends ApiController
{

    public function __invoke(Request $request, Uuid $id)
    {
        $account = $this->query()->execute((new FindAccountById($id))->with($this->includes($request)));

        return $this->item((new ObjectType($account, AccountViewTransformer::class))->withIncludes($this->includes($request)));
    }
}
