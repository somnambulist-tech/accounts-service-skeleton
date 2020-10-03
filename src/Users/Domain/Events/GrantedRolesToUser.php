<?php declare(strict_types=1);

namespace App\Users\Domain\Events;

use Somnambulist\Domain\Events\AbstractEvent;

/**
 * Class GrantedRolesToUser
 *
 * @package    App\Users\Domain\Events
 * @subpackage App\Users\Domain\Events\GrantedRolesToUser
 */
class GrantedRolesToUser extends AbstractEvent
{
    protected string $group = 'user';
}
