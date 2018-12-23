<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181223142650 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE created_at_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE people_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE created_at (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE people (id INT NOT NULL, uid INT NOT NULL, know_for_department VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, also_know_as TEXT DEFAULT NULL, gender INT DEFAULT NULL, biography TEXT DEFAULT NULL, popularity DOUBLE PRECISION DEFAULT NULL, place_of_birth VARCHAR(255) DEFAULT NULL, profile_path VARCHAR(255) DEFAULT NULL, adult BOOLEAN DEFAULT NULL, imdb_id VARCHAR(255) DEFAULT NULL, homepage VARCHAR(255) DEFAULT NULL, birthday DATE DEFAULT NULL, deathday DATE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN people.also_know_as IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE created_at_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE people_id_seq CASCADE');
        $this->addSql('DROP TABLE created_at');
        $this->addSql('DROP TABLE people');
    }
}
