<?php declare(strict_types=1);

namespace App\Accounts\Domain\Events;

use Somnambulist\Domain\Events\AbstractEvent;

/**
 * Class AccountActivated
 *
 * @package    App\Accounts\Domain\Events
 * @subpackage App\Accounts\Domain\Events\AccountActivated
 */
class AccountActivated extends AbstractEvent
{
    protected string $group = 'account';
}
