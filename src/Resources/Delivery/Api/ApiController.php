<?php declare(strict_types=1);

namespace App\Resources\Delivery\Api;

use Somnambulist\Bundles\ApiBundle\Controllers\ApiController as BaseController;
use Somnambulist\Components\Domain\Commands\CommandBus;
use Somnambulist\Components\Domain\Jobs\JobQueue;
use Somnambulist\Components\Domain\Queries\QueryBus;

/**
 * Class ApiController
 *
 * @package    App\Resources\Delivery\Api
 * @subpackage App\Resources\Delivery\Api\ApiController
 */
abstract class ApiController extends BaseController
{

    public static function getSubscribedServices()
    {
        return array_merge(parent::getSubscribedServices(), [
            CommandBus::class,
            QueryBus::class,
            JobQueue::class,
        ]);
    }

    protected function query(): QueryBus
    {
        return $this->get(QueryBus::class);
    }

    protected function command(): CommandBus
    {
        return $this->get(CommandBus::class);
    }

    protected function job(): JobQueue
    {
        return $this->get(JobQueue::class);
    }
}
