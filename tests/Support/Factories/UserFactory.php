<?php declare(strict_types=1);

namespace App\Tests\Support\Factories;

use App\Users\Domain\Models\AccountId;
use App\Users\Domain\Models\Permission;
use App\Users\Domain\Models\PermissionName;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\RoleName;
use App\Users\Domain\Models\User;
use App\Users\Domain\Models\UserName;
use Faker\Generator;
use Somnambulist\Components\Domain\Entities\Types\Auth\Password;
use Somnambulist\Components\Domain\Entities\Types\Identity\EmailAddress;
use Somnambulist\Components\Domain\Utils\IdentityGenerator;

class UserFactory
{

    private Generator $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    public function email(): EmailAddress
    {
        return new EmailAddress($this->faker->email);
    }

    public function accountId(): AccountId
    {
        return new AccountId(IdentityGenerator::random()->toString());
    }

    public function name(string $name = null): UserName
    {
        return new UserName($name ?? $this->faker->name);
    }

    public function password($algo = PASSWORD_BCRYPT, array $options = []): Password
    {
        return new Password(password_hash('password', $algo, $options));
    }

    public function role(string $name = 'role'): Role
    {
        return new Role(IdentityGenerator::random(), new RoleName($name));
    }

    public function user(AccountId $accountId = null, EmailAddress $email = null, Password $password = null, UserName $name = null): User
    {
        return User::create(
            IdentityGenerator::random(),
            $accountId ?? $this->accountId(),
            $email ?? $this->email(),
            $password ?? $this->password(),
            $name ?? $this->name(),
        );
    }

    /**
     * @param string ...$permission
     *
     * @return array|Permission[]|Permission
     */
    public function permission(string ...$permission)
    {
        $tmp = [];

        foreach ($permission as $name) {
            $tmp[] = new Permission(new PermissionName($name));
        }

        return (count($tmp) == 1) ? $tmp[0] : $tmp;
    }
}
