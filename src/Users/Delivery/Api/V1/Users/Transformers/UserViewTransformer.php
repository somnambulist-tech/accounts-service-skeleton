<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Users\Transformers;

use App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer;
use App\Users\Delivery\Api\V1\Permissions\Transformers\PermissionViewTransformer;
use App\Users\Delivery\Api\V1\Roles\Transformers\RoleViewTransformer;
use App\Users\Delivery\ViewModels\UserView;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class UserViewTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['account', 'permissions', 'roles',];

    public function transform(UserView $user): array
    {
        return $user->toArray();
    }

    public function includeAccount(UserView $user): Item
    {
        return $this->item($user->account, AccountViewTransformer::class);
    }

    public function includePermissions(UserView $user): Collection
    {
        return $this->collection($user->permissions, PermissionViewTransformer::class);
    }

    public function includeRoles(UserView $user): Collection
    {
        return $this->collection($user->roles, RoleViewTransformer::class);
    }
}
