<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Domain\Commands\DestroyUser;
use Somnambulist\Components\Models\Types\Identity\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class DestroyController extends ApiController
{
    public function __invoke(Uuid $id): JsonResponse
    {
        $this->command()->dispatch(new DestroyUser($id));

        return $this->deleted($id);
    }
}
