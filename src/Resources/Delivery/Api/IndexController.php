<?php declare(strict_types=1);

namespace App\Resources\Delivery\Api;

use Symfony\Component\HttpFoundation\JsonResponse;

class IndexController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'services' => [
                'accounts', 'permissions', 'roles', 'users',
            ]
        ]);
    }
}
