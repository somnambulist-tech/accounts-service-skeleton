<?php declare(strict_types=1);

namespace App\Accounts\Delivery\Api\V1\Accounts\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use App\Accounts\Delivery\ViewModels\AccountView;
use App\Users\Delivery\Api\V1\Users\Transformers\UserViewTransformer;

/**
 * Class AccountViewTransformer
 *
 * @package    App\Accounts\Delivery\Api\V1\Accounts\Transformers
 * @subpackage App\Accounts\Delivery\Api\V1\Accounts\Transformers\AccountViewTransformer
 */
class AccountViewTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['users',];

    public function transform(AccountView $account): array
    {
        return $account->toArray();
    }

    public function includeUsers(AccountView $account): Collection
    {
        return $this->collection($account->users, UserViewTransformer::class);
    }
}
