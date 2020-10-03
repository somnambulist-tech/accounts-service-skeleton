<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Permissions\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Domain\Commands\DestroyPermission;

/**
 * Class CreateController
 *
 * @package    App\Users\Delivery\Api\V1\Permissions\Controllers
 * @subpackage App\Users\Delivery\Api\V1\Permissions\Controllers\CreateController
 */
class DestroyController extends ApiController
{

    public function __invoke(string $id)
    {
        $this->command()->dispatch(new DestroyPermission($id));

        return $this->deleted($id);
    }
}
