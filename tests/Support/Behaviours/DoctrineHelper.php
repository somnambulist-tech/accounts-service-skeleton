<?php declare(strict_types=1);

namespace App\Tests\Support\Behaviours;

use Doctrine\ORM\EntityManagerInterface;
use Somnambulist\Domain\Doctrine\AbstractEntityLocator;

/**
 * Trait DoctrineHelper
 *
 * @package    App\Tests\Support\Behaviours
 * @subpackage App\Tests\Support\Behaviours\DoctrineHelper
 */
trait DoctrineHelper
{

    protected function doctrine(): EntityManagerInterface
    {
        return static::$container->get('doctrine')->getManager();
    }

    protected function locatorFor(string $class): AbstractEntityLocator
    {
        return static::$container->get('doctrine')->getManager()->getRepository($class);
    }
}
