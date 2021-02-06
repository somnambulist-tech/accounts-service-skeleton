<?php declare(strict_types=1);

namespace App\Users\Domain\Models;

use App\Users\Domain\Events as Event;
use App\Users\Domain\Models\User\UserPermissions;
use App\Users\Domain\Models\User\UserRoles;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Somnambulist\Components\Domain\Entities\AggregateRoot;
use Somnambulist\Components\Domain\Entities\Types\Auth\Password;
use Somnambulist\Components\Domain\Entities\Types\Identity\EmailAddress;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;

/**
 * Class User
 *
 * @package    App\Users\Domain\Models
 * @subpackage App\Users\Domain\Models\User
 */
class User extends AggregateRoot
{

    private AccountId $account;
    private EmailAddress $email;
    private Password $password;
    private UserName $name;
    private bool     $active;
    private Collection $permissions;
    private Collection $roles;

    private function __construct(Uuid $id, AccountId $account, EmailAddress $email, Password $password, UserName $name)
    {
        $this->id       = $id;
        $this->account  = $account;
        $this->email    = $email;
        $this->password = $password;
        $this->name     = $name;
        $this->active   = false;

        $this->permissions = new ArrayCollection();
        $this->roles       = new ArrayCollection();

        $this->initializeTimestamps();
    }

    public static function create(Uuid $uuid, AccountId $account, EmailAddress $email, Password $password, UserName $name): self
    {
        $entity = new static($uuid, $account, $email, $password, $name);

        $entity->raise(Event\UserCreated::class, [
            'id'         => (string)$uuid,
            'account_id' => (string)$account,
            'email'      => (string)$email,
        ]);

        return $entity;
    }

    public function activate(): void
    {
        $this->active = true;

        $this->raise(Event\UserActivated::class, [
            'id' => (string)$this->id(),
        ]);
    }

    public function deactivate(): void
    {
        $this->active = false;

        $this->raise(Event\UserDeactivated::class, [
            'id' => (string)$this->id(),
        ]);
    }

    public function changeAuthCredentials(EmailAddress $email, Password $password): void
    {
        $this->email    = $email;
        $this->password = $password;

        $this->raise(Event\UserAuthenticationCredentialsChanged::class, [
            'id'    => (string)$this->id(),
            'email' => (string)$email,
        ]);
    }

    public function changeAccount(AccountId $account): void
    {
        $this->account = $account;

        $this->raise(Event\UserAccountChanged::class, [
            'id'         => (string)$this->id(),
            'account_id' => (string)$this->account,
            'email'      => (string)$this->email,
        ]);
    }

    public function changeName(UserName $name): void
    {
        $this->name = $name;

        $this->raise(Event\UserNameChanged::class, [
            'id'   => (string)$this->id(),
            'name' => (string)$name,
        ]);
    }

    public function destroy(): void
    {
        $this->raise(Event\UserDestroyed::class, [
            'id' => (string)$this->id(),
        ]);
    }

    public function permissions(): UserPermissions
    {
        return new UserPermissions($this, $this->permissions);
    }

    public function roles(): UserRoles
    {
        return new UserRoles($this, $this->roles);
    }
}
