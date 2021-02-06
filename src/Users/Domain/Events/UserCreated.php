<?php declare(strict_types=1);

namespace App\Users\Domain\Events;

use Somnambulist\Components\Domain\Events\AbstractEvent;

/**
 * Class UserCreated
 *
 * @package    App\Users\Domain\Events
 * @subpackage App\Users\Domain\Events\UserCreated
 */
class UserCreated extends AbstractEvent
{
    protected string $group = 'user';
}
