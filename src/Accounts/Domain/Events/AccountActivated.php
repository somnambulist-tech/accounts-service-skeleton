<?php declare(strict_types=1);

namespace App\Accounts\Domain\Events;

use Somnambulist\Components\Events\AbstractEvent;

class AccountActivated extends AbstractEvent
{
    protected string $group = 'account';
}
