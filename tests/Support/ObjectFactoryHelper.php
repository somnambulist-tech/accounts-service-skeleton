<?php declare(strict_types=1);

namespace App\Tests\Support;

use App\Tests\Support\Factories\AccountFactory;
use App\Tests\Support\Factories\UserFactory;
use Faker\Factory;
use Faker\Generator;
use InvalidArgumentException;
use RuntimeException;
use Somnambulist\Components\Domain\Entities\Types\Identity\Uuid;
use Somnambulist\Components\Domain\Utils\IdentityGenerator;
use function array_key_exists;
use function array_keys;
use function in_array;
use function sprintf;

/**
 * @property-read Uuid           $uuid
 * @property-read Generator      $faker
 * @property-read AccountFactory $account
 * @property-read UserFactory    $user
 *
 * @method AccountFactory account()
 * @method UserFactory    user()
 */
class ObjectFactoryHelper
{

    private array $factories;
    private Generator $faker;

    public function __construct(string $locale = Factory::DEFAULT_LOCALE)
    {
        $this->faker     = Factory::create($locale);
        $this->factories = [
            'account' => new AccountFactory(),
            'user'    => new UserFactory($this->faker),
        ];
    }

    public function __call($name, $arguments)
    {
        return $this->magicHelper($name, $arguments, 'Method "%s" not found on "%s"');
    }

    public function __get($name)
    {
        return $this->magicHelper($name);
    }

    private function magicHelper(string $name, array $arguments = [], string $message = 'Property "%s" not found on "%s"'): object
    {
        if ('uuid' === $name) {
            return $this->uuid();
        }
        if ('faker' === $name) {
            return $this->faker;
        }

        if (in_array($name, array_keys($this->factories))) {
            return $this->from($name);
        }

        throw new RuntimeException(sprintf($message, $name, static::class));
    }

    /**
     * @return Generator
     * @see https://fakerphp.github.io/formatters/
     */
    public function faker(): Generator
    {
        return $this->faker;
    }

    /**
     * Returns a mapped factory object matching the key name
     *
     * @param string $name
     *
     * @return mixed
     */
    public function from(string $name)
    {
        if (array_key_exists($name, $this->factories)) {
            return $this->factories[$name];
        }

        throw new InvalidArgumentException(sprintf('No factory has been configured for "%s"', $name));
    }

    public function uuid(): Uuid
    {
        return IdentityGenerator::new();
    }
}
