<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Domain\Commands\DestroyAccount;
use App\Resources\Delivery\Api\ApiController;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DestroyController
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Controllers
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Controllers\DestroyController
 */
class DestroyController extends ApiController
{
    public function __invoke(Uuid $id): JsonResponse
    {
        $this->command()->dispatch(new DestroyAccount($id));

        return $this->deleted($id);
    }
}
