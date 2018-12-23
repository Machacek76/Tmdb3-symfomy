<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181217124817 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE movie ALTER genres_id TYPE TEXT');
        $this->addSql('ALTER TABLE movie ALTER genres_id DROP DEFAULT');
        $this->addSql('ALTER TABLE movie ALTER genres_id DROP NOT NULL');
        $this->addSql('ALTER TABLE movie ALTER producion_companies_id TYPE TEXT');
        $this->addSql('ALTER TABLE movie ALTER producion_companies_id DROP DEFAULT');
        $this->addSql('ALTER TABLE movie ALTER production_countries_id TYPE TEXT');
        $this->addSql('ALTER TABLE movie ALTER production_countries_id DROP DEFAULT');
        $this->addSql('ALTER TABLE movie ALTER spoken_languages_id TYPE TEXT');
        $this->addSql('ALTER TABLE movie ALTER spoken_languages_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN movie.genres_id IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN movie.producion_companies_id IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN movie.production_countries_id IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN movie.spoken_languages_id IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE movie ALTER genres_id TYPE INT');
        $this->addSql('ALTER TABLE movie ALTER genres_id DROP DEFAULT');
        $this->addSql('ALTER TABLE movie ALTER genres_id SET NOT NULL');
        $this->addSql('ALTER TABLE movie ALTER producion_companies_id TYPE INT');
        $this->addSql('ALTER TABLE movie ALTER producion_companies_id DROP DEFAULT');
        $this->addSql('ALTER TABLE movie ALTER production_countries_id TYPE INT');
        $this->addSql('ALTER TABLE movie ALTER production_countries_id DROP DEFAULT');
        $this->addSql('ALTER TABLE movie ALTER spoken_languages_id TYPE INT');
        $this->addSql('ALTER TABLE movie ALTER spoken_languages_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN movie.genres_id IS NULL');
        $this->addSql('COMMENT ON COLUMN movie.producion_companies_id IS NULL');
        $this->addSql('COMMENT ON COLUMN movie.production_countries_id IS NULL');
        $this->addSql('COMMENT ON COLUMN movie.spoken_languages_id IS NULL');
    }
}
