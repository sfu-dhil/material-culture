<?php declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191024234555 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artefact_bottle ADD packaging_location_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artefact_bottle ADD CONSTRAINT FK_EEED6798E2383B3D FOREIGN KEY (packaging_location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_EEED6798E2383B3D ON artefact_bottle (packaging_location_id)');
        $this->addSql('ALTER TABLE artefact_can ADD packaging_location_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artefact_can ADD CONSTRAINT FK_315E4591E2383B3D FOREIGN KEY (packaging_location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_315E4591E2383B3D ON artefact_can (packaging_location_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artefact_bottle DROP FOREIGN KEY FK_EEED6798E2383B3D');
        $this->addSql('DROP INDEX IDX_EEED6798E2383B3D ON artefact_bottle');
        $this->addSql('ALTER TABLE artefact_bottle DROP packaging_location_id');
        $this->addSql('ALTER TABLE artefact_can DROP FOREIGN KEY FK_315E4591E2383B3D');
        $this->addSql('DROP INDEX IDX_315E4591E2383B3D ON artefact_can');
        $this->addSql('ALTER TABLE artefact_can DROP packaging_location_id');
    }
}
