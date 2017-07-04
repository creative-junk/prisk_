<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170512091800 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recording (id INT AUTO_INCREMENT NOT NULL, main_artist_id VARCHAR(255) NOT NULL, created_by_id VARCHAR(255) DEFAULT NULL, updated_by_id VARCHAR(255) DEFAULT NULL, isrc VARCHAR(255) DEFAULT NULL, skiza_id VARCHAR(255) DEFAULT NULL, recording_title VARCHAR(255) NOT NULL, main_artist_country VARCHAR(255) DEFAULT NULL, featured_artist VARCHAR(255) DEFAULT NULL, genre VARCHAR(255) NOT NULL, language VARCHAR(255) DEFAULT NULL, country_of_recording VARCHAR(255) DEFAULT NULL, country_first_published DATETIME DEFAULT NULL, type_of_recording VARCHAR(255) DEFAULT NULL, av_work VARCHAR(255) DEFAULT NULL, duration VARCHAR(255) DEFAULT NULL, date_of_publication DATETIME DEFAULT NULL, recording_studio1 VARCHAR(255) DEFAULT NULL, recording_studio2 VARCHAR(255) DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, album_title VARCHAR(255) DEFAULT NULL, album_type VARCHAR(255) DEFAULT NULL, record_label VARCHAR(255) DEFAULT NULL, country_of_publication VARCHAR(255) DEFAULT NULL, bar_code VARCHAR(255) DEFAULT NULL, catalogue_nr VARCHAR(255) DEFAULT NULL, date_of_first_release VARCHAR(255) DEFAULT NULL, track_title VARCHAR(255) DEFAULT NULL, track_nr VARCHAR(255) DEFAULT NULL, side_nr VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_BB532B539721AB5A (main_artist_id), INDEX IDX_BB532B53B03A8386 (created_by_id), INDEX IDX_BB532B53896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recording ADD CONSTRAINT FK_BB532B539721AB5A FOREIGN KEY (main_artist_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE recording ADD CONSTRAINT FK_BB532B53B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE recording ADD CONSTRAINT FK_BB532B53896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE recording');
    }
}
