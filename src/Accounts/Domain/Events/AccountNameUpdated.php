<?php declare(strict_types=1);

namespace App\Accounts\Domain\Events;

use Somnambulist\Components\Domain\Events\AbstractEvent;

/**
 * Class AccountNameUpdated
 *
 * @package    App\Accounts\Domain\Events
 * @subpackage App\Accounts\Domain\Events\AccountNameUpdated
 */
class AccountNameUpdated extends AbstractEvent
{
    protected string $group = 'account';
}
