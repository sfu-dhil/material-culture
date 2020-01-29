<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191025235742 extends AbstractMigration {
    public function up(Schema $schema) : void {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artefact_ceramic DROP FOREIGN KEY FK_BA9F769A50266CBB');
        $this->addSql('DROP INDEX IDX_BA9F769A50266CBB ON artefact_ceramic');
        $this->addSql('RENAME TABLE form TO vessel');
        $this->addSql('ALTER TABLE artefact_ceramic RENAME COLUMN shape_id TO vessel_id');
        $this->addSql('ALTER TABLE artefact_ceramic ADD CONSTRAINT FK_BA9F769A14AF1953 FOREIGN KEY (vessel_id) REFERENCES vessel (id)');
        $this->addSql('CREATE INDEX IDX_BA9F769A14AF1953 ON artefact_ceramic (vessel_id)');
    }

    public function down(Schema $schema) : void {
        $this->throwIrreversibleMigrationException();
    }
}
