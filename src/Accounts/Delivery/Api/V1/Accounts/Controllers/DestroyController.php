<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Controllers;

use App\Accounts\Domain\Commands\DestroyAccount;
use App\Resources\Delivery\Api\ApiController;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class DestroyController extends ApiController
{
    public function __invoke(Uuid $id): JsonResponse
    {
        $this->command()->dispatch(new DestroyAccount($id));

        return $this->deleted($id);
    }
}
