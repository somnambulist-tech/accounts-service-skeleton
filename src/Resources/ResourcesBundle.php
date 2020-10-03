<?php declare(strict_types=1);

namespace App\Resources;

use App\Users\Infrastructure\Persistence\Types\NameType;
use Somnambulist\Domain\Doctrine\TypeBootstrapper;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ResourcesBundle
 *
 * @package    App\Resources
 * @subpackage App\Resources\ResourcesBundle
 */
class ResourcesBundle extends Bundle
{

    public function boot()
    {
        $this->registerDoctrineTypesAndEnumerations();
    }

    private function registerDoctrineTypesAndEnumerations()
    {
        TypeBootstrapper::registerEnumerations();
        TypeBootstrapper::registerTypes(TypeBootstrapper::$types);

        TypeBootstrapper::registerType('users_name', NameType::class);
    }
}
