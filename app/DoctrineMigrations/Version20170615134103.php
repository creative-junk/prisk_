<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170615134103 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE next_of_kin (id VARCHAR(255) NOT NULL, whose_kin_id VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, relationship VARCHAR(255) NOT NULL, id_number VARCHAR(255) NOT NULL, percent INT NOT NULL, physical_address VARCHAR(255) NOT NULL, postal_address VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_CE1E3CF9D1AC38B2 (whose_kin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE next_of_kin ADD CONSTRAINT FK_CE1E3CF9D1AC38B2 FOREIGN KEY (whose_kin_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profile DROP next_of_kin_first_name, DROP next_of_kin_last_name, DROP next_of_kin_relationship, DROP next_of_kin_id_number, DROP next_of_kin_percent, DROP next_of_kin_physical_address, DROP next_of_kin_postal_address, DROP next_of_kin_postal_code, DROP next_of_kin_city, DROP next_of_kin_country, DROP next_of_kin_phone_number, DROP next_of_kin_email, DROP next_of_kin_added_date');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE next_of_kin');
        $this->addSql('ALTER TABLE profile ADD next_of_kin_first_name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD next_of_kin_last_name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD next_of_kin_relationship VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD next_of_kin_id_number VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD next_of_kin_percent VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD next_of_kin_physical_address VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD next_of_kin_postal_address VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD next_of_kin_postal_code VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD next_of_kin_city VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD next_of_kin_country VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD next_of_kin_phone_number VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD next_of_kin_email VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD next_of_kin_added_date DATE DEFAULT NULL');
    }
}
