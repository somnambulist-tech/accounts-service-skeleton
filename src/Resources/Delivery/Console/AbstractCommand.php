<?php declare(strict_types=1);

namespace App\Resources\Delivery\Console;

use LogicException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractCommand extends Command implements ContainerAwareInterface
{
    private ?ContainerInterface $container = null;

    /**
     * @return ContainerInterface
     *
     * @throws LogicException
     */
    protected function getContainer(): ContainerInterface
    {
        if (null === $this->container) {
            $application = $this->getApplication();
            if (null === $application) {
                throw new LogicException('The container cannot be retrieved as the application instance is not yet set.');
            }

            $this->container = $application->getKernel()->getContainer();
        }

        return $this->container;
    }

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null): void
    {
        $this->container = $container;
    }
}
