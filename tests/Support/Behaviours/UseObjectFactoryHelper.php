<?php declare(strict_types=1);

namespace App\Tests\Support\Behaviours;

use App\Tests\Support\Factories\AccountFactory;
use App\Tests\Support\Factories\UserFactory;
use App\Tests\Support\ObjectFactoryHelper;
use Faker\Factory;
use Faker\Generator;
use InvalidArgumentException;
use Somnambulist\Domain\Entities\Types\Identity\Uuid;
use function sprintf;

/**
 * Trait UseObjectFactoryHelper
 *
 * @package    App\Tests\Support\Behaviours
 * @subpackage App\Tests\Support\Behaviours\UseObjectFactoryHelper
 *
 * @property-read Generator           $faker
 * @property-read ObjectFactoryHelper $factory
 *
 * @property-read Uuid           $uuid
 * @property-read AccountFactory $account
 * @property-read UserFactory    $user
 */
trait UseObjectFactoryHelper
{

    private ?ObjectFactoryHelper $unitTester = null;

    public function __get($name)
    {
        switch ($name) {
            case 'faker': return $this->factory()->faker();
            case 'factory': return $this->factory();

            case 'account': return $this->factory()->account;
            case 'user': return $this->factory()->user;
            case 'uuid': return $this->factory()->uuid;
        }

        throw new InvalidArgumentException(sprintf('No property found for "%s"', $name));
    }

    protected function factory(string $locale = Factory::DEFAULT_LOCALE): ObjectFactoryHelper
    {
        if (!$this->unitTester instanceof ObjectFactoryHelper) {
            $this->unitTester = new ObjectFactoryHelper($locale);
        }

        return $this->unitTester;
    }
}
