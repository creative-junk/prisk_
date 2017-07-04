<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170613154452 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profile CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE processed_at processed_at DATETIME DEFAULT NULL, CHANGE account_created account_created VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD profile_linked_at DATETIME DEFAULT NULL, ADD account_created_at DATETIME DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profile CHANGE created_at created_at DATETIME NOT NULL, CHANGE processed_at processed_at DATETIME NOT NULL, CHANGE account_created account_created VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE user DROP profile_linked_at, DROP account_created_at');
    }
}
