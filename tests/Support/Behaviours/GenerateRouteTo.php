<?php declare(strict_types=1);

namespace App\Tests\Support\Behaviours;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @property ContainerInterface static $container
 */
trait GenerateRouteTo
{
    /**
     * Create a route from the named route with the specified parameters
     *
     * @param string $name
     * @param array  $parameters
     *
     * @return mixed
     */
    protected function routeTo(string $name, array $parameters = []): string
    {
        return static::getContainer()->get('router')->getGenerator()->generate($name, $parameters);
    }
}
