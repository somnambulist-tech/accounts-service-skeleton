<?php declare(strict_types=1);

namespace App\Accounts\Domain\Events;

use Somnambulist\Components\Domain\Events\AbstractEvent;

/**
 * Class AccountDestroyed
 *
 * @package    App\Accounts\Domain\Events
 * @subpackage App\Accounts\Domain\Events\AccountDestroyed
 */
class AccountDestroyed extends AbstractEvent
{
    protected string $group = 'account';
}
