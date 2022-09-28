<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Permissions\Transformers;

use App\Users\Delivery\ViewModels\PermissionView;
use League\Fractal\TransformerAbstract;

class PermissionViewTransformer extends TransformerAbstract
{
    public function transform(PermissionView $permission): array
    {
        return $permission->toArray();
    }
}
