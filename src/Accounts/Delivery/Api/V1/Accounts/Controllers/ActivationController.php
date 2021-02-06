<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer;
use App\Accounts\Domain\Commands\ActivateAccount;
use App\Accounts\Domain\Commands\DeactivateAccount;
use App\Accounts\Domain\Queries\FindAccountById;
use App\Resources\Delivery\Api\ApiController;
use Somnambulist\Bundles\ApiBundle\Response\Types\ObjectType;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Class ActivationController
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Controllers
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Controllers\ActivationController
 */
class ActivationController extends ApiController
{

    public function activateAction(Uuid $id)
    {
        $this->command()->dispatch(new ActivateAccount($id));

        return $this->updated(new ObjectType($this->query()->execute(new FindAccountById($id)), AccountViewTransformer::class));
    }

    public function deactivateAction(Uuid $id)
    {
        $this->command()->dispatch(new DeactivateAccount($id));

        return $this->updated(new ObjectType($this->query()->execute(new FindAccountById($id)), AccountViewTransformer::class));
    }
}
