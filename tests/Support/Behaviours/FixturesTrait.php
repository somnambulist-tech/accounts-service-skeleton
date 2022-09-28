<?php declare(strict_types=1);

namespace App\Tests\Support\Behaviours;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

trait FixturesTrait
{
    public function loadFixtures(array $classNames = [], bool $append = false)
    {
        self::getContainer()->get(DatabaseToolCollection::class)->get()->loadFixtures($classNames, $append);
    }
}
