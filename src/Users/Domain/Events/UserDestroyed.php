<?php declare(strict_types=1);

namespace App\Users\Domain\Events;

use Somnambulist\Domain\Events\AbstractEvent;

/**
 * Class UserDestroyed
 *
 * @package    App\Users\Domain\Events
 * @subpackage App\Users\Domain\Events\UserDestroyed
 */
class UserDestroyed extends AbstractEvent
{
    protected string $group = 'user';
}
