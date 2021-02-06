<?php declare(strict_types=1);

namespace App\Users\Domain\Events;

use Somnambulist\Components\Domain\Events\AbstractEvent;

/**
 * Class GrantedPermissionsToUser
 *
 * @package    App\Users\Domain\Events
 * @subpackage App\Users\Domain\Events\GrantedPermissionsToUser
 */
class GrantedPermissionsToUser extends AbstractEvent
{
    protected string $group = 'user';
}
