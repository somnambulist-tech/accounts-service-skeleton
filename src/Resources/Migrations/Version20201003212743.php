<?php

declare(strict_types=1);

namespace App\Resources\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20201003212743
 *
 * @package    App\Resources\Migrations
 * @subpackage App\Resources\Migrations\Version20201003212743
 */
final class Version20201003212743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add accounts, users, roles, and permissions tables';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accounts (id UUID NOT NULL, name VARCHAR(255) NOT NULL, active BOOLEAN DEFAULT \'false\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_accounts_active ON accounts (active)');
        $this->addSql('COMMENT ON COLUMN accounts.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE permissions (id INT GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX uniq_permissions_name ON permissions (name)');
        $this->addSql('CREATE TABLE roles (id UUID NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_roles_name ON roles (name)');
        $this->addSql('COMMENT ON COLUMN roles.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE role_permissions (role_id UUID NOT NULL, permission_id INT NOT NULL, PRIMARY KEY(role_id, permission_id))');
        $this->addSql('CREATE INDEX IDX_1FBA94E6D60322AC ON role_permissions (role_id)');
        $this->addSql('CREATE INDEX IDX_1FBA94E6FED90CCA ON role_permissions (permission_id)');
        $this->addSql('COMMENT ON COLUMN role_permissions.role_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE role_grantable_roles (role_source UUID NOT NULL, role_target UUID NOT NULL, PRIMARY KEY(role_source, role_target))');
        $this->addSql('CREATE INDEX IDX_97DCCC2F4AC9EC2 ON role_grantable_roles (role_source)');
        $this->addSql('CREATE INDEX IDX_97DCCC2ED49CE4D ON role_grantable_roles (role_target)');
        $this->addSql('COMMENT ON COLUMN role_grantable_roles.role_source IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN role_grantable_roles.role_target IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, active BOOLEAN DEFAULT \'false\' NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, account_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_users_account_id ON users (account_id)');
        $this->addSql('CREATE INDEX idx_users_active ON users (active)');
        $this->addSql('CREATE UNIQUE INDEX uniq_users_email ON users (email)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE user_permissions (user_id UUID NOT NULL, permission_id INT NOT NULL, PRIMARY KEY(user_id, permission_id))');
        $this->addSql('CREATE INDEX IDX_84F605FAA76ED395 ON user_permissions (user_id)');
        $this->addSql('CREATE INDEX IDX_84F605FAFED90CCA ON user_permissions (permission_id)');
        $this->addSql('COMMENT ON COLUMN user_permissions.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE user_roles (user_id UUID NOT NULL, role_id UUID NOT NULL, PRIMARY KEY(user_id, role_id))');
        $this->addSql('CREATE INDEX IDX_54FCD59FA76ED395 ON user_roles (user_id)');
        $this->addSql('CREATE INDEX IDX_54FCD59FD60322AC ON user_roles (role_id)');
        $this->addSql('COMMENT ON COLUMN user_roles.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_roles.role_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE role_permissions ADD CONSTRAINT FK_1FBA94E6D60322AC FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_permissions ADD CONSTRAINT FK_1FBA94E6FED90CCA FOREIGN KEY (permission_id) REFERENCES permissions (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_grantable_roles ADD CONSTRAINT FK_97DCCC2F4AC9EC2 FOREIGN KEY (role_source) REFERENCES roles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_grantable_roles ADD CONSTRAINT FK_97DCCC2ED49CE4D FOREIGN KEY (role_target) REFERENCES roles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_permissions ADD CONSTRAINT FK_84F605FAA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_permissions ADD CONSTRAINT FK_84F605FAFED90CCA FOREIGN KEY (permission_id) REFERENCES permissions (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FD60322AC FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_permissions DROP CONSTRAINT FK_1FBA94E6FED90CCA');
        $this->addSql('ALTER TABLE user_permissions DROP CONSTRAINT FK_84F605FAFED90CCA');
        $this->addSql('ALTER TABLE role_permissions DROP CONSTRAINT FK_1FBA94E6D60322AC');
        $this->addSql('ALTER TABLE role_grantable_roles DROP CONSTRAINT FK_97DCCC2F4AC9EC2');
        $this->addSql('ALTER TABLE role_grantable_roles DROP CONSTRAINT FK_97DCCC2ED49CE4D');
        $this->addSql('ALTER TABLE user_roles DROP CONSTRAINT FK_54FCD59FD60322AC');
        $this->addSql('ALTER TABLE user_permissions DROP CONSTRAINT FK_84F605FAA76ED395');
        $this->addSql('ALTER TABLE user_roles DROP CONSTRAINT FK_54FCD59FA76ED395');
        $this->addSql('DROP TABLE accounts');
        $this->addSql('DROP TABLE permissions');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE role_permissions');
        $this->addSql('DROP TABLE role_grantable_roles');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE user_permissions');
        $this->addSql('DROP TABLE user_roles');
    }
}
