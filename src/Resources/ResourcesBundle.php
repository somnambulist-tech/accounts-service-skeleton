<?php declare(strict_types=1);

namespace App\Resources;

use App\Users\Infrastructure\Persistence\Types\PermissionNameType;
use App\Users\Infrastructure\Persistence\Types\RoleNameType;
use App\Users\Infrastructure\Persistence\Types\UserNameType;
use Somnambulist\Components\Doctrine\TypeBootstrapper;
use Symfony\Component\HttpKernel\Bundle\Bundle;

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

        TypeBootstrapper::registerType('permission_name', PermissionNameType::class);
        TypeBootstrapper::registerType('role_name', RoleNameType::class);
        TypeBootstrapper::registerType('user_name', UserNameType::class);
    }
}
