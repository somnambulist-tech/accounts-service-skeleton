<?php declare(strict_types=1);

namespace App\Tests\Support\Behaviours;

use App\Tests\Support\ObjectFactoryHelper;
use Faker\Factory;

trait UseObjectFactoryHelper
{

    private ?ObjectFactoryHelper $factory = null;

    protected function factory(string $locale = Factory::DEFAULT_LOCALE): ObjectFactoryHelper
    {
        if (!$this->factory instanceof ObjectFactoryHelper) {
            $this->factory = new ObjectFactoryHelper($locale);
        }

        return $this->factory;
    }
}
