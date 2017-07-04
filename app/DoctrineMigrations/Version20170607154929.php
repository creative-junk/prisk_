<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170607154929 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profile ADD mpesa_payment_date DATETIME DEFAULT NULL, ADD mpesa_status VARCHAR(255) DEFAULT NULL, ADD mpesa_description VARCHAR(255) DEFAULT NULL, ADD mpesa_number VARCHAR(255) DEFAULT NULL, ADD mpesa_amount VARCHAR(255) DEFAULT NULL, ADD is_urlvalid TINYINT(1) DEFAULT NULL, CHANGE phone_number phone_number INT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profile DROP mpesa_payment_date, DROP mpesa_status, DROP mpesa_description, DROP mpesa_number, DROP mpesa_amount, DROP is_urlvalid, CHANGE phone_number phone_number VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
