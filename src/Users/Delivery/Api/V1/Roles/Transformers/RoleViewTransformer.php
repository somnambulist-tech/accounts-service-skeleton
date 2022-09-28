<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Roles\Transformers;

use App\Users\Delivery\Api\V1\Permissions\Transformers\PermissionViewTransformer;
use App\Users\Delivery\ViewModels\RoleView;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class RoleViewTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['roles', 'permissions',];

    public function transform(RoleView $role): array
    {
        return $role->toArray();
    }

    public function includePermissions(RoleView $role): Collection
    {
        return $this->collection($role->permissions, PermissionViewTransformer::class);
    }

    public function includeRoles(RoleView $role): Collection
    {
        return $this->collection($role->roles, RoleViewTransformer::class);
    }
}
