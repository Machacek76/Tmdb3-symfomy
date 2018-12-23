<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181222215327 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE movie_videos_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE movie_videos (id INT NOT NULL, movie_id INT NOT NULL, uid VARCHAR(255) NOT NULL, iso_639_1 VARCHAR(6) NOT NULL, iso_3166_1 VARCHAR(6) DEFAULT NULL, key VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, site VARCHAR(255) DEFAULT NULL, size INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE movie_videos_id_seq CASCADE');
        $this->addSql('DROP TABLE movie_videos');
    }
}
