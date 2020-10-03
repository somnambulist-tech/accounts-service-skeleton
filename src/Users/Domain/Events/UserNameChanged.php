<?php declare(strict_types=1);

namespace App\Users\Domain\Events;

use Somnambulist\Domain\Events\AbstractEvent;

/**
 * Class UserNameChanged
 *
 * @package    App\Users\Domain\Events
 * @subpackage App\Users\Domain\Events\UserNameChanged
 */
class UserNameChanged extends AbstractEvent
{
    protected string $group = 'user';
}
