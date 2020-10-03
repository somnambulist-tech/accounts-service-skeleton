<?php declare(strict_types=1);

namespace App\Tests\Support;

use Faker\Factory;
use Faker\Generator;
use InvalidArgumentException;
use App\Tests\Support\Factories\AccountFactory;
use App\Tests\Support\Factories\UserFactory;
use RuntimeException;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;
use Somnambulist\Domain\Utils\IdentityGenerator;
use function array_key_exists;

/**
 * Class ObjectFactoryHelper
 *
 * @package    App\Tests\Support
 * @subpackage App\Tests\Support\ObjectFactoryHelper
 *
 * @property-read Uuid           $uuid
 * @property-read Generator      $faker
 * @property-read AccountFactory $account
 * @property-read UserFactory    $user
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

    public function __get($name)
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

        throw new RuntimeException(sprintf('Property "%s" not found on "%s"', $name, static::class));
    }

    /**
     * @see https://github.com/fzaninotto/Faker#formatters
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
        return IdentityGenerator::random();
    }
}
