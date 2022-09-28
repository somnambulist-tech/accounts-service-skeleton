<?php declare(strict_types=1);

namespace App\Accounts\Domain\Models;

use App\Accounts\Domain\Events as Event;
use Assert\Assert;
use Somnambulist\Components\Models\AggregateRoot;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class Account extends AggregateRoot
{
    protected string $name;
    protected bool   $active;

    private function __construct(Uuid $id, string $name)
    {
        Assert::that($name, null, 'name')->notBlank()->notEmpty()->maxLength(255);

        $this->id     = $id;
        $this->name   = $name;
        $this->active = false;

        $this->initializeTimestamps();
    }

    public static function create(Uuid $id, string $name): self
    {
        $entity = new static($id, $name);

        $entity->raise(Event\AccountCreated::class, [
            'name' => $name,
        ]);

        return $entity;
    }

    public function activate(): void
    {
        $this->active = true;

        $this->raise(Event\AccountActivated::class);
    }

    public function deactivate(): void
    {
        $this->active = false;

        $this->raise(Event\AccountDeactivated::class);
    }

    public function destroy(): void
    {
        $this->raise(Event\AccountDestroyed::class);
    }

    public function changeName(string $name): void
    {
        Assert::that($name, null, 'name')->notBlank()->notEmpty()->maxLength(255);

        $this->name = $name;

        $this->raise(Event\AccountNameUpdated::class, [
            'name' => $name,
        ]);
    }
}
