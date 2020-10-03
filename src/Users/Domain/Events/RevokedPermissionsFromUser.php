<?php declare(strict_types=1);

namespace App\Users\Domain\Events;

use Somnambulist\Domain\Events\AbstractEvent;

/**
 * Class RevokedPermissionsFromUser
 *
 * @package    App\Users\Domain\Events
 * @subpackage App\Users\Domain\Events\RevokedPermissionsFromUser
 */
class RevokedPermissionsFromUser extends AbstractEvent
{
    protected string $group = 'user';
}
