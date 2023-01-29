<?php declare(strict_types=1);

namespace App\Resources\Delivery\Api;

use Somnambulist\Bundles\ApiBundle\Controllers\ApiController as BaseController;
use Somnambulist\Bundles\ApiBundle\Controllers\Behaviours\AddDomainServicesHelpers;

abstract class ApiController extends BaseController
{
    use AddDomainServicesHelpers;
}
