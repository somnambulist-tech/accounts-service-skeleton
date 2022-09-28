<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use App\Users\Domain\Models\AccountId;
use Somnambulist\Components\Commands\AbstractCommand;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class CreateUser extends AbstractCommand
{

    private Uuid $id;
    private AccountId $account;
    private string $email;
    private string $password;
    private string $name;
    private array $roles;
    private array $permissions;

    public function __construct(Uuid $id, AccountId $account, string $email, string $password, string $name, array $roles = [], array $permissions = [])
    {
        $this->id          = $id;
        $this->account     = $account;
        $this->email       = $email;
        $this->password    = $password;
        $this->name        = $name;
        
        $this->roles       = $roles;
        $this->permissions = $permissions;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getAccount(): AccountId
    {
        return $this->account;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }
}
