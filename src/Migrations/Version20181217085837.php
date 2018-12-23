<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181217085837 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE spoken_language_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE movie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE spoken_language (id INT NOT NULL, iso_639_1 VARCHAR(12) NOT NULL, name VARCHAR(255) DEFAULT NULL, cs_name VARCHAR(12) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, update_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE movie (id INT NOT NULL, uid INT NOT NULL, backdrop_path VARCHAR(255) DEFAULT NULL, adult BOOLEAN DEFAULT NULL, budget INT DEFAULT NULL, homepage VARCHAR(255) DEFAULT NULL, genres_id INT NOT NULL, imdb_id INT DEFAULT NULL, original_language VARCHAR(255) DEFAULT NULL, original_title VARCHAR(255) DEFAULT NULL, overview TEXT DEFAULT NULL, popularity DOUBLE PRECISION DEFAULT NULL, poster_path VARCHAR(255) DEFAULT NULL, producion_companies_id INT DEFAULT NULL, production_countries_id INT DEFAULT NULL, release_date DATE DEFAULT NULL, revenue DOUBLE PRECISION DEFAULT NULL, runtime INT DEFAULT NULL, spoken_languages_id INT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, tagline VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, video BOOLEAN DEFAULT NULL, voteaverage DOUBLE PRECISION DEFAULT NULL, votecount INT DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE spoken_language_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE movie_id_seq CASCADE');
        $this->addSql('DROP TABLE spoken_language');
        $this->addSql('DROP TABLE movie');
    }
}
