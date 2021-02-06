<?php declare(strict_types=1);

namespace App\Users\Domain\Events;

use Somnambulist\Components\Domain\Events\AbstractEvent;

/**
 * Class UserDeactivated
 *
 * @package    App\Users\Domain\Events
 * @subpackage App\Users\Domain\Events\UserDeactivated
 */
class UserDeactivated extends AbstractEvent
{
    protected string $group = 'user';
}
