<?php declare(strict_types=1);

namespace App\Users\Delivery\Api\V1\Permissions\Transformers;

use App\Users\Delivery\ViewModels\PermissionView;
use League\Fractal\TransformerAbstract;

/**
 * Class PermissionViewTransformer
 *
 * @package    App\Users\Delivery\Api\V1\Permissions\Transformers
 * @subpackage App\Users\Delivery\Api\V1\Permissions\Transformers\PermissionViewTransformer
 */
class PermissionViewTransformer extends TransformerAbstract
{

    public function transform(PermissionView $permission)
    {
        return $permission->toArray();
    }
}
