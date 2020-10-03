<?php declare(strict_types=1);

namespace App\Accounts\Domain\Events;

use Somnambulist\Domain\Events\AbstractEvent;

/**
 * Class AccountCreated
 *
 * @package    App\Accounts\Domain\Events
 * @subpackage App\Accounts\Domain\Events\AccountCreated
 */
class AccountCreated extends AbstractEvent
{
    protected string $group = 'account';
}
