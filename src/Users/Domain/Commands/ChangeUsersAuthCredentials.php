<?php declare(strict_types=1);

namespace App\Users\Domain\Commands;

use Somnambulist\Components\Commands\AbstractCommand;
use Somnambulist\Components\Models\Types\Identity\Uuid;

class ChangeUsersAuthCredentials extends AbstractCommand
{

    private Uuid $id;
    private string $email;
    private string $password;

    public function __construct(Uuid $id, string $email, string $password)
    {
        $this->id       = $id;
        $this->email    = $email;
        $this->password = $password;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
