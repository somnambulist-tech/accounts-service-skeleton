<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Domain\Commands\DestroyUser;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;

/**
 * Class DestroyController
 *
 * @package    App\Users\Delivery\Api\V1\Users\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Users\Controllers\DestroyController
 */
class DestroyController extends ApiController
{

    public function __invoke(Uuid $id)
    {
        $this->command()->dispatch(new DestroyUser($id));

        return $this->deleted($id);
    }
}
