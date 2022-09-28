<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Somnambulist\Components\Utils\IdentityGenerator;

final class Version20201003220231 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add required starter roles';
    }

    public function up(Schema $schema) : void
    {
        $root = IdentityGenerator::random()->toString();
        $user = IdentityGenerator::random()->toString();
        $su   = IdentityGenerator::random()->toString();
        $adm  = IdentityGenerator::random()->toString();

        $this->addSql('
            INSERT INTO roles (id, name, created_at, updated_at)
            VALUES
                (:user, \'user\', NOW(), NOW()),
                (:root, \'root\', NOW(), NOW()),
                (:admin, \'admin\', NOW(), NOW()),
                (:su, \'switch_user\', NOW(), NOW())
        ', [
            'user'  => $user,
            'root'  => $root,
            'admin' => $adm,
            'su'    => $su,
        ]);
        $this->addSql('
            INSERT INTO role_grantable_roles (role_source, role_target)
            VALUES 
                (:root, :user),
                (:root, :root),
                (:root, :admin),
                (:root, :su)
        ', [
            'user'  => $user,
            'root'  => $root,
            'admin' => $adm,
            'su'    => $su,
        ]);
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('TRUNCATE roles CASCADE');
    }
}
