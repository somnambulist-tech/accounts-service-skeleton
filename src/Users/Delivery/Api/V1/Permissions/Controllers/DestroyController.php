<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Permissions\Controllers;

use App\Resources\Delivery\Api\ApiController;
use App\Users\Domain\Commands\DestroyPermission;
use Symfony\Component\HttpFoundation\JsonResponse;

class DestroyController extends ApiController
{
    public function __invoke(string $id): JsonResponse
    {
        $this->command()->dispatch(new DestroyPermission($id));

        return $this->deleted($id);
    }
}
