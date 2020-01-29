<?php declare(strict_types=1);

namespace AppBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191028174942 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE typology (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(120) NOT NULL, label VARCHAR(120) NOT NULL, description LONGTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, FULLTEXT INDEX IDX_1596C8F8EA750E8 (label), FULLTEXT INDEX IDX_1596C8F86DE44026 (description), FULLTEXT INDEX IDX_1596C8F8EA750E86DE44026 (label, description), UNIQUE INDEX UNIQ_1596C8F85E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artefact_ceramic ADD typology_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artefact_ceramic ADD CONSTRAINT FK_BA9F769AC7D98C7A FOREIGN KEY (typology_id) REFERENCES typology (id)');
        $this->addSql('CREATE INDEX IDX_BA9F769AC7D98C7A ON artefact_ceramic (typology_id)');
        $this->addSql('ALTER TABLE vessel RENAME INDEX idx_5288fd4fea750e8 TO IDX_4ED8DCA8EA750E8');
        $this->addSql('ALTER TABLE vessel RENAME INDEX idx_5288fd4f6de44026 TO IDX_4ED8DCA86DE44026');
        $this->addSql('ALTER TABLE vessel RENAME INDEX idx_5288fd4fea750e86de44026 TO IDX_4ED8DCA8EA750E86DE44026');
        $this->addSql('ALTER TABLE vessel RENAME INDEX uniq_5288fd4f5e237e06 TO UNIQ_4ED8DCA85E237E06');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE typology');
        $this->addSql('ALTER TABLE artefact_ceramic DROP FOREIGN KEY FK_BA9F769AC7D98C7A');
        $this->addSql('DROP INDEX IDX_BA9F769AC7D98C7A ON artefact_ceramic');
        $this->addSql('ALTER TABLE artefact_ceramic DROP typology_id');
        $this->addSql('ALTER TABLE vessel RENAME INDEX idx_4ed8dca8ea750e8 TO IDX_5288FD4FEA750E8');
        $this->addSql('ALTER TABLE vessel RENAME INDEX idx_4ed8dca8ea750e86de44026 TO IDX_5288FD4FEA750E86DE44026');
        $this->addSql('ALTER TABLE vessel RENAME INDEX uniq_4ed8dca85e237e06 TO UNIQ_5288FD4F5E237E06');
        $this->addSql('ALTER TABLE vessel RENAME INDEX idx_4ed8dca86de44026 TO IDX_5288FD4F6DE44026');
    }
}
