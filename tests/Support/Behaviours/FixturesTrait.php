<?php declare(strict_types=1);

namespace App\Tests\Support\Behaviours;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

/**
 * Trait FixturesTrait
 *
 * @package    App\Tests\Support\Behaviours
 * @subpackage App\Tests\Support\Behaviours\FixturesTrait
 */
trait FixturesTrait
{

    public function loadFixtures(array $classNames = [], bool $append = false)
    {
        self::getContainer()->get(DatabaseToolCollection::class)->get()->loadFixtures($classNames, $append);
    }
}
