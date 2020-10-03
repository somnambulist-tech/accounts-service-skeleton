<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Delivery\Api\V1\Accounts\Forms\ChangeAccountNameRequest;
use App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer;
use App\Accounts\Domain\Commands\ChangeAccountName;
use App\Accounts\Domain\Queries\FindAccountById;
use App\Resources\Delivery\Api\ApiController;
use Somnambulist\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Class ChangeNameController
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Controllers
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Controllers\ChangeNameController
 */
class ChangeNameController extends ApiController
{

    public function __invoke(ChangeAccountNameRequest $request, Uuid $id)
    {
        $this->command()->dispatch(new ChangeAccountName($id, $request->get('name')));

        return $this->updated(new ObjectType($this->query()->execute(new FindAccountById($id)), AccountViewTransformer::class));
    }
}
