<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\Migrations\Exception\IrreversibleMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200904210613 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $sql = <<<ENDSQL
            ALTER TABLE image 
                CHANGE image_file_path image_path VARCHAR(128) NOT NULL, 
                CHANGE thumbnail_path thumb_path VARCHAR(128) NOT NULL, 
                CHANGE image_width image_width INT NOT NULL, 
                CHANGE image_height image_height INT NOT NULL;
ENDSQL;
        $this->addSql($sql);
    }

    public function down(Schema $schema) : void
    {
        $this->throwIrreversibleMigrationException();
    }
}
