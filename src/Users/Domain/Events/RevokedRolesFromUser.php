<?php declare(strict_types=1);

namespace App\Users\Domain\Events;

use Somnambulist\Domain\Events\AbstractEvent;

/**
 * Class RevokedRolesFromUser
 *
 * @package    App\Users\Domain\Events
 * @subpackage App\Users\Domain\Events\RevokedRolesFromUser
 */
class RevokedRolesFromUser extends AbstractEvent
{
    protected string $group = 'user';
}
