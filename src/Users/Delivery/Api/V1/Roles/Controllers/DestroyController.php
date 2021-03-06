<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Domain\Commands\DestroyRole;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Class DestroyController
 *
 * @package    App\Users\Delivery\Api\V1\Roles\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Roles\Controllers\DestroyController
 */
class DestroyController extends ApiController
{

    public function __invoke(Uuid $id)
    {
        $this->command()->dispatch(new DestroyRole($id));

        return $this->deleted($id);
    }
}
