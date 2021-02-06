<?php declare(strict_types=1);

namespace App\Users\Domain\Events;

use Somnambulist\Components\Domain\Events\AbstractEvent;

/**
 * Class UserAccountChanged
 *
 * @package    App\Users\Domain\Events
 * @subpackage App\Users\Domain\Events\UserAccountChanged
 */
class UserAccountChanged extends AbstractEvent
{
    protected string $group = 'user';
}
