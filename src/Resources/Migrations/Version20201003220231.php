<?php

declare(strict_types=1);

namespace App\Resources\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Somnambulist\Components\Domain\Utils\IdentityGenerator;

/**
 * Class Version20201003220231
 *
 * @package    App\Resources\Migrations
 * @subpackage App\Resources\Migrations\Version20201003220231
 */
final class Version20201003220231 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add required starter roles';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
            ':user'  => $user,
            ':root'  => $root,
            ':admin' => $adm,
            ':su'    => $su,
        ]);
        $this->addSql('
            INSERT INTO role_grantable_roles (role_source, role_target)
            VALUES 
                (:root, :user),
                (:root, :root),
                (:root, :admin),
                (:root, :su)
        ', [
            ':user'  => $user,
            ':root'  => $root,
            ':admin' => $adm,
            ':su'    => $su,
        ]);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE roles CASCADE');
    }
}
