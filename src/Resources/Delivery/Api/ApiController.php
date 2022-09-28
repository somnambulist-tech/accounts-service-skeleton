<?php declare(strict_types=1);

namespace App\Resources\Delivery\Api;

use Somnambulist\Bundles\ApiBundle\Controllers\ApiController as BaseController;
use Somnambulist\Components\Commands\CommandBus;
use Somnambulist\Components\Jobs\JobQueue;
use Somnambulist\Components\Queries\QueryBus;

abstract class ApiController extends BaseController
{
    public static function getSubscribedServices(): array
    {
        return array_merge(parent::getSubscribedServices(), [
            CommandBus::class,
            QueryBus::class,
            JobQueue::class,
        ]);
    }

    protected function query(): QueryBus
    {
        return $this->container->get(QueryBus::class);
    }

    protected function command(): CommandBus
    {
        return $this->container->get(CommandBus::class);
    }

    protected function job(): JobQueue
    {
        return $this->container->get(JobQueue::class);
    }
}
