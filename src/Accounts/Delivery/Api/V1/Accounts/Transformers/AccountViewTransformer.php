<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Transformers;

use App\Accounts\Delivery\ViewModels\AccountView;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class AccountViewTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['users',];

    public function transform(AccountView $account): array
    {
        return $account->toArray();
    }

    public function includeUsers(AccountView $account): Collection
    {
        return $this->collection($account->users, UserViewTransformer::class);
    }
}
