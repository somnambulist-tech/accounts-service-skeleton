<?php declare(strict_types=1);

namespace App\Resources\Delivery\Api;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class IndexController
 *
 * @package    App\Resources\Delivery\Api
 * @subpackage App\Resources\Delivery\Api\IndexController
 */
class IndexController extends ApiController
{

    public function __invoke()
    {
        return new JsonResponse([
            'services' => [
                'accounts', 'permissions', 'roles', 'users',
            ]
        ]);
    }
}
