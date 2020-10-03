<?php declare(strict_types=1);

namespace App\Accounts\Domain\Events;

use Somnambulist\Domain\Events\AbstractEvent;

/**
 * Class AccountDeactivated
 *
 * @package    App\Accounts\Domain\Events
 * @subpackage App\Accounts\Domain\Events\AccountDeactivated
 */
class AccountDeactivated extends AbstractEvent
{
    protected string $group = 'account';
}
